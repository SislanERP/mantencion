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

    $consulta = "call consulta_total_horas_paras('$menor','$mayor')";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $total = strtotime($columna['total']);
    }
    else{echo mysql_error(conectar());}

    echo "total: ".$total. " - menor: " .$menor. " - mayor: ".$mayor;

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
            <td class="font-weight-bold" style="font-size:20px;"><?php echo $total;?></td>
        </tr>
    </table>