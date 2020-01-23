<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Detenciones</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
    <style>
    @page {
            margin:1.5em;
        }
    </style>
</head>

<?php
    $suma_detencion = '00:00';
    $fecha = $_SESSION['fecha_detencion']; 
    $consulta = "call  consulta_encabezado_detencion('$fecha')";
    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    while ($columna = mysqli_fetch_array( $resultado ))
    {
        $camiones = $columna['camiones'];
        $kilos_mm = number_format($columna['kilos_mm_pp'], 0, ",", ".");
        $kilos_producidos = number_format($columna['kilos_producidos'], 0, ",", ".");
        $rendimiento = $columna['rendimiento'];
        $kilos_embolsado = number_format($columna['kilos_embolsado'], 0, ",", ".");
    }
?>

<body class="bl">
    <div>
        <table class="w-100">
            <tr>
                <td class="border border-dark text-center" colspan="8" style="background:#C6E0B4;">Fecha: <?php echo date("d/m/Y", strtotime($fecha));?></td>
            </tr>
            <tr>
                <td class="border border-dark text-center" colspan="8">Turno Día y Noche</td>
            </tr>
            
            <tr>
                <td class="border border-dark text-center" style="width:220px;">Cantidad Camiones</td>
                <td colspan="7" class="border border-dark text-center"><?php echo $camiones;?></td>
            </tr>
            <tr>
                <td class="border border-dark text-center" style="width:220px;">Kilos Mm. PP</td>
                <td colspan="7" class="border border-dark text-center"><?php echo $kilos_mm;?></td>
            </tr>
            <tr>
                <td class="border border-dark text-center" style="width:220px;">Kilos Producidos</td>
                <td colspan="7" class="border border-dark text-center"><?php echo $kilos_producidos;?></td>
            </tr>
            <tr>
                <td class="border border-dark text-center" style="width:220px;">% Rendimiento</td>
                <td colspan="7" class="border border-dark text-center"><?php echo $rendimiento;?></td>
            </tr>
            <tr>
                <td class="border border-dark text-center" style="width:220px;">Kilos Producto Embolsado</td>
                <td colspan="7" class="border border-dark text-center"><?php  echo $kilos_embolsado;?></td>
            </tr>
            <tr>
                <td class="border border-dark text-center" colspan="8" style="background:#FFE699;">Problemas Mecanicos</td>
            </tr>

            <tr>
                <td class="border border-dark text-center" style="background:#D6DEEF;">Tipo Falla</td>
                <td class="border border-dark text-center" style="background:#D6DEEF;">Equipo</td>
                <td class="border border-dark text-center" style="background:#D6DEEF;" colspan="3">Descripción</td>
                <td class="border border-dark text-center" style="background:#D6DEEF;">Hora Falla</td>
                <td class="border border-dark text-center" style="background:#D6DEEF;">Tiempo Muerto</td>
                <td class="border border-dark text-center" style="background:#D6DEEF;">Detención</td>
            </tr>

            <?php
                $fecha = $_SESSION['fecha_detencion']; 
                $consulta = "call  consulta_detalle_detencion('$fecha')";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna = mysqli_fetch_array( $resultado ))
                {
                    $falla = strtotime($columna['hora_falla']);
                    $tiempo = strtotime($columna['tiempo']);

                    echo    "<tr>
                                <td class='border border-dark text-center'>".$columna['tipo_falla']."</td>
                                <td class='border border-dark text-center'>".$columna['equipo']."</td>
                                <td colspan='3' class='border border-dark text-center'>".$columna['descripcion']."</td>
                                <td class='border border-dark text-center'>".date("H:i",$falla)."</td>
                                <td class='border border-dark text-center'>".date("H:i",$tiempo)."</td>";
                             
							    if ($columna['detencion'] == 1){
						
							        echo    "<td class='border border-dark text-center'><img src='../../../img/iconos/no.svg' alt='' class='btn-accion align-self-center' style='width:24px;'></td>";
								
							    }else{
						
							        echo    "<td class='border border-dark text-center'><img src='../../../img/iconos/si.svg' alt='' class='btn-accion align-self-center' style='width:24px;'></td>";
					
							    }
                }
            ?>

        </table>
    </div>
    <div class="w-100 d-flex">
        <div class="w-25">
            <table class="w-100 mt-4">
                <tr>
                    <td class='border border-dark text-center' style="background:#D6DEEF;" colspan="2">Total Horas Detención Proceso</td>
                </tr>
                <?php
                    $fecha = $_SESSION['fecha_detencion']; 
                    $consulta = "call   consulta_tipo_falla()";
                    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    while ($columna = mysqli_fetch_array( $resultado ))
                    {
                        echo    "<tr>
                                    <td class='border border-dark text-center w-75'>".$columna['tipo']."</td>
                                    <td class='border border-dark text-center'>";
                                        $consul = "call consulta_total_horas_detencion_tipo_falla($columna[id_tipo_falla],'$fecha',1)";
                                        $resul = mysqli_query(conectar(), $consul ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                                        if ($colum = mysqli_fetch_array( $resul ))
                                        {
                                            $suma = strtotime($colum['suma']);
                                            if(empty($suma))
                                            {
                                                echo "00:00";
                                            }else{
                                                echo date("H:i",$suma);
                                            }
                                        }
                            echo    "</td>
                                </tr>";
                    }
                ?>
                <tr>
                    <td class='border border-dark text-center'><b>Total Horas Detención</b></td>
                    <td class='border border-dark text-center'>
                        <b>
                            <?php
                                $fecha = $_SESSION['fecha_detencion']; 
                                $con = "call  consulta_total_horas_detencion('$fecha',1)";
                                $re = mysqli_query(conectar(), $con ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                                if ($co = mysqli_fetch_array( $re ))
                                {
                                    $total_suma = strtotime($co['total']);
                                    if(empty($total_suma))
                                    {
                                        echo "00:00";
                                    }
                                    else{
                                        echo date("H:i",$total_suma);
                                    }
                                }
                            ?>
                        </b>
                    </td>
                </tr>
            </table>
        </div>

        <div class="w-25" style="padding-left:350px;">
            <table class="w-100 mt-4">
                <tr>
                    <td class='border border-dark text-center' style="background:#D6DEEF;" colspan="2">Total Horas <b>NO</b> Detención Proceso</td>
                </tr>
                <?php
                    $fecha = $_SESSION['fecha_detencion']; 
                    $consulta = "call   consulta_tipo_falla()";
                    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    while ($columna = mysqli_fetch_array( $resultado ))
                    {
                        echo    "<tr>
                                    <td class='border border-dark text-center w-75'>".$columna['tipo']."</td>
                                    <td class='border border-dark text-center'>";
                                        $consul = "call consulta_total_horas_detencion_tipo_falla($columna[id_tipo_falla],'$fecha',0)";
                                        $resul = mysqli_query(conectar(), $consul ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                                        if ($colum = mysqli_fetch_array( $resul ))
                                        {
                                                
                                            $suma = strtotime($colum['suma']);
                                            if(empty($suma))
                                            {
                                                echo "00:00";
                                            }else{
                                                echo date("H:i",$suma);
                                            }
                                        }
                            echo    "</td>
                                </tr>";
                    }
                ?>
                <tr>
                    <td class='border border-dark text-center'><b>Total Horas <b>NO</b> Detención</b></td>
                    <td class='border border-dark text-center'>
                        <b>
                            <?php
                                $fecha = $_SESSION['fecha_detencion']; 
                                $con = "call  consulta_total_horas_detencion('$fecha',0)";
                                $re = mysqli_query(conectar(), $con ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                                if ($co = mysqli_fetch_array( $re ))
                                {
                                    $total_suma = strtotime($co['total']);
                                    if(empty($total_suma))
                                    {
                                        echo "00:00";
                                    }
                                    else{
                                        echo    date("H:i",$total_suma);
                                    }
                                }
                            ?>
                        </b>
                    </td>
                </tr>
            </table>
        </div>
    </div> 
</body>
</html>