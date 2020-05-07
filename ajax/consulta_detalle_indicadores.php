<?php
    session_start();
    require_once("../php/conexion.php");

    $menor = $_REQUEST['menor'];
    $mayor = $_REQUEST['mayor'];
    $id = $_REQUEST['id'];
    $tiempo = $_REQUEST['tiempo'];

    $consulta = "call consulta_detalle_indicador('$menor','$mayor',$id)";
    $resultado = mysqli_query( conectar(), $consulta );
?>
    <table class='table'>
        <thead class='thead-light'>
            <tr>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Tiempo</th>
            </tr>
        </thead>
        <tbody>
             <?php
                    while ($columna = mysqli_fetch_array( $resultado ))
                    {
                        echo "<tr>
                                <td>".date("d/m/Y", strtotime($columna['fecha']))."</td>
                                <td>".$columna['detalle']."</td>
                                <td>".str_replace(":00", "", $columna['tiempo'])."</td>
                            </tr>";
                    }
             ?>           
             <tr>
                    <td class="font-weight-bold" style="font-size:20px;">Total</td>
                    <td></td>
                    <td class="font-weight-bold" style="font-size:20px;"><?php echo date("H:i",$tiempo)?></td>
             </tr>
        </tbody>
    </table>
    