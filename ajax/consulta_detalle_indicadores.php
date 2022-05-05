<?php
    session_start();
    require_once("../php/conexion.php");

    $menor = $_REQUEST['menor'];
    $mayor = $_REQUEST['mayor'];
    $id = $_REQUEST['id'];
    $tiempo = "00:00:00";
    $consulta = "call consulta_equipo_por_ubicacion('$menor','$mayor',$id)";
    $resultado = mysqli_query( conectar(), $consulta );
?>

    <div class="accordion" id="accordionExample">
    <?php
        while ($columna = mysqli_fetch_array( $resultado ))
        {
            $tiempo = 0;
    ?>
            <div class="card">
                <div class="card-header" id="heading<?=$columna['id']?>">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?=$columna['id']?>" aria-expanded="false" aria-controls="collapse<?=$columna['id']?>">
                    <?=$columna['equipo']?>
                    </button>
                </h2>
                </div>

                <div id="collapse<?=$columna['id']?>" class="collapse show" aria-labelledby="heading<?=$columna['id']?>" data-parent="#accordionExample">
                <div class="card-body">
                    <?php 
                        $equipo = $columna['id'];
                        $consulta1 = "call consulta_detalle_indicador('$menor','$mayor',$equipo)";
                        $resultado1 = mysqli_query( conectar(), $consulta1 );
                    ?>
                            <table class='table responsive'>
                                <thead class='thead-light'>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Detalle</th>
                                        <th>Tiempo</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                    
                        while ($columna1 = mysqli_fetch_array( $resultado1 ))
                        {
                            //$tiempo= $tiempo + strtotime($columna1['tiempo']);
                            echo "<tr>
                                    <td>".date("d/m/Y", strtotime($columna1['fecha']))."</td>
                                    <td>".$columna1['detalle']."</td>
                                    <td>".date("H:i", strtotime($columna1['tiempo']))."</td>
                                </tr>";
                        }
                    ?>
                                    <tr>
                                        <td class="font-weight-bold" style="font-size:20px;">Total</td>
                                        <td></td>
                                        <td class="font-weight-bold" style="font-size:20px;"><?php echo date("H:i",strtotime($columna['suma']));?></td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    <?php
        }
    ?>      
        
        
    </div>

    <script>
        $('.collapse').collapse();

    </script>
    
    