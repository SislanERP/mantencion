<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Preventivo</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
    <style>
       @page { margin: 180px 50px; }
       #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center; }
       #footer { position: fixed; left: 0px; bottom: -80px; right: 0px; height: 150px; }
       #footer .page:after { content: counter(page, upper-roman); }
     </style>
    <style>
        td{font-size:12px;padding:3px !important;margin:3px !important;}
        ul{margin:1px !important;   }
    </style>
</head>

<body class="bl">
<script type="text/php">
    if ( isset($pdf) ) { 
        $pdf->page_script('
        if ($PAGE_COUNT >= 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 9;
            $pageText = "Página " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 48;
            $x = 465;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}
</script> 
    <table id="header" class="table table-bordered ">
        <thead>
            <tr>
                <td  rowspan="4" class="p-1" style="width:10%;vertical-align: inherit;"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
                <td rowspan="4" class="text-center font-weight-bold p-1" style="vertical-align: inherit; width:62%;"><h3>ORDEN DE TRABAJO <br>R13   </br></h3></td>
                <td class="text-center p-1" style="font-size: 12px;">Versión</td>
                <td class="text-center p-1" style="font-size: 12px;">0.2</td>
                <tr>
                    <td class="text-center p-1" colspan="2" style="font-size: 12px;height:18px;"></td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 12px;">Fecha Elab</td>
                    <td class="text-center p-1" style="font-size: 12px;">23/01/2020</td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 12px;">Fecha Rev</td>
                    <td class="text-center p-1" style="font-size: 12px;">02/02/2021</td>
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
            $responsable = $columna['responsable'];
            echo    "<div style='border: 1px solid #dee2e6;width:100%;padding:15px;margin-bottom:-30px;'>
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
                            <div style='float:right;margin-right:74px;'>
                                <span style='display:inline-block;'>Prioridad</span>
                                <span style='display:inline-block;'>: ".$columna['prioridad']."</span>
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
                    ";
        }    
    ?>
    <div style="margin-bottom:-60px;">
            <?php
                $consulta = "call consulta_plantilla_equipo($id_equipo)";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                if ($columna = mysqli_fetch_array( $resultado ))
                {
                    echo $columna['detalle'];
                }  
            ?>
    </div>

    <table class="w-100" id="footer">
        <tr>
            <td class="text-center">___________________</td>
            <td class="text-center">___________________</td>
        </tr>
        <tr>
            <td class="text-center">Realizado Por</td>
            <td class="text-center flota-right"><Var>Verificado</Var> Por</td>
        </tr>
        
    </table>
</body>
</html>