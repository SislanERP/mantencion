<?php 
    session_start();
    require_once("../php/conexion.php");

    if(empty($_POST['año']))
    {
?>
        <div class="alert alert-warning alert-dismissable mt-3">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>Aviso!!!</h4> No hay datos para mostrar
        </div>
<?php }
    
    else
    {
        $consulta = "call consulta_dia_menor($_POST[mes], $_POST[año])";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        {
            $menor = $columna['menor'];
            $consulta = "call consulta_dia_mayor($_POST[mes], $_POST[año])";
            $resultado = mysqli_query( conectar(), $consulta );
            if ($columna = mysqli_fetch_array( $resultado ))
            {
                $mayor = $columna['mayor'];
            }
        
            $consulta1 = "call consulta_total_horas_paras('$menor','$mayor')";
            $resultado1 = mysqli_query( conectar(), $consulta1 );
            if ($columna1 = mysqli_fetch_array( $resultado1 ))
            {
                $total = $columna1['total'];
            }
        
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
                    <td class="font-weight-bold" style="font-size:20px;"><?php echo str_replace(":00", "", $total);?></td>
                </tr>
            </table>
        <?php 
        } 
        
        else
        { ?>
            <div class="alert alert-warning alert-dismissable mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
<?php }} ?>
        
    