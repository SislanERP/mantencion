<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Preventivo</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
</head>

<body class="bl">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <td  rowspan="4" class="p-1" style="width:10%;vertical-align: inherit;"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
                <td rowspan="4" class="text-center font-weight-bold p-1" style="vertical-align: inherit; width:55%;"><h3>ORDEN DE TRABAJO <br>R13   </br></h3></td>
                <td class="text-center p-1" style="font-size: 12px;">Versión</td>
                <td class="text-center p-1" style="font-size: 12px;">0.1</td>
                <tr>
                    <td class="text-center p-1" colspan="2" style="font-size: 12px;">Página 1 de 1</td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 12px;">Fecha Elaboración</td>
                    <td class="text-center p-1" style="font-size: 12px;">23/01/2020</td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 12px;">Fecha Revisión</td>
                    <td class="text-center p-1" style="font-size: 12px;">23/01/2020</td>
                </tr>
            </tr>
        <thead>
    </table>

    <?php
        $id = $_GET["id"];
        $consulta = "call consulta_report_preventivo($id)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        while ($columna = mysqli_fetch_array( $resultado ))
        {
            $id_equipo = $columna['id_equipo'];
            echo    "<div style='border: 1px solid #dee2e6;width:100%;padding:15px;'>
                        <div class='d-flex w-100'>
                            <div>
                                <span style='display:inline-block;width:150px;'>N° Preventivo</span>
                                <span style='display:inline-block;''>: ".$columna['id']."</span>
                            </div>
                            <div style='float:right;'>
                                <span style='display:inline-block;'>Fecha Inicio</span>
                                <span style='display:inline-block;'>: ".date("d/m/Y", strtotime($columna['fecha']))."</span>
                            </div>
                        </div>
                        <div class='d-flex w-100'>
                            <div>
                                <span style='display:inline-block;width:150px;'>Responsable</span>
                                <span style='display:inline-block;'>: ".$columna['responsable']."</span>
                            </div>
                        </div>
                        <div class='d-flex w-100'>
                            <div>
                                <span style='display:inline-block;width:150px;'>Tipo Mantenimiento</span>
                                <span style='display:inline-block;'>: ".$columna['tipo_mantenimiento']."</span>
                            </div>
                        </div>
                        <div>
                            <span style='display:inline-block;width:150px;'>Nombre Equipo</span>
                            <span style='display:inline-block;'>: ".$columna['equipo']."</span>
                        </div>
                    </div>


        
                    <div class='w-100' style='margin-top:150px;'>
                        <div class='d-flex w-100'>
                            <span>Responsable</span>
                            <span style='float:right;'>V°B Jefe Mantención</span>
                        </div>
                        <div class='w-100'>
                            <span class='font-weight-bold'>".$columna['responsable']."</span>
                            <img src='../../../img/firmas/boris.png' alt='' style='width:200px;position:fixed;float:right;bottom:180px;'>
                        </div>
                    </div>
                    ";
        }    
    ?>
    <div>
        <span>
            <?php
                $consulta = "call consulta_plantilla_equipo($id_equipo)";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                if ($columna = mysqli_fetch_array( $resultado ))
                {
                    echo $columna['detalle'];
                }  
            ?></span>
    </div>
</body>
</html>