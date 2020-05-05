<?php 
    session_start();
    require_once("../php/conexion.php");
    $consulta = "call consulta_dia_menor($_POST[mes])";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $menor = $columna['menor'];
    }

    $consulta = "call consulta_dia_mayor($_POST[mes])";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $mayor = $columna['mayor'];
    }

    $consulta1 = "call consulta_total_horas_paras('$menor','$mayor')";
	$resultado1 = mysqli_query( conectar(), $consulta1 );
	if ($columna1 = mysqli_fetch_array( $resultado1 ))
	{
        $total = strtotime($columna1['total']);
    }
    else{echo "error";}

    $consulta = "call consulta_paras_por_equipos('$menor','$mayor')";
    $resultado = mysqli_query( conectar(), $consulta );
    ?>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>Equipos</th>
                <th>Tiempo</th>
            </tr>
        </thead>
    <?php
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        $time = strtotime($columna['suma']);
        echo "<tr>
                <td>".$columna['equipo']."</td>
                <td>".date("H:i",$time)."</td>
            </tr>";
    }
?>

        <tr>
            <td class="font-weight-bold" style="font-size:20px;">Total</td>
            <td class="font-weight-bold" style="font-size:20px;"><?php echo date("H:i",$total);?></td>
        </tr>
    </table>