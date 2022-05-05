<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Preventivo</title>
    <style>
       @page { margin: 180px 50px; }
       #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center; }
       #footer { position: fixed; left: 0px; bottom: -80px; right: 0px; height: 150px; }
       #footer .page:after { content: counter(page, upper-roman); }
     </style>
    <style>
        td{font-size:15px; padding:3px;}
        ul{margin:1px !important;}
        .border{border:1px solid #c3c3c3;}
        .bl{border-left:1px solid #c3c3c3;}
        .br{border-right:1px solid #c3c3c3;}
        .bb{border-bottom:1px solid #c3c3c3;}
        .table{width:100%;border:1px solid #c3c3c3;}
        .table td{border:1px solid #c3c3c3;}
        table{border-spacing:0px;}
    </style>
</head>

<body>
<script type="text/php">
    if ( isset($pdf) ) { 
        $pdf->page_script('
        if ($PAGE_COUNT >= 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 9;
            $pageText = "Página " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 50;
            $x = 465;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}
</script> 
    <table id="header" width="100%" class="border">
        <thead>
            <?php 
                $consulta = "call consulta_informe(1)";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna = mysqli_fetch_array( $resultado ))
                {
            ?>
                <tr>
                    <td class="br" rowspan="4" style="width:10%;"><img src="../../../img/brand/logo.png" alt="" style="width:90px;"></td>
                    <td class="br" rowspan="4" style="width:60%;"><h3><?=$columna['informe']?> <br><?=$columna['registro']?>   </br></h3></td>
                    <td class="br bb" style="font-size: 12px;">Versión</td>
                    <td class="bb" style="font-size: 12px;"><?=$columna['version']?></td>
                    <tr>
                        <td class="bb" colspan="2" style="font-size: 12px;height:18px;"></td>
                    </tr>
                    <tr>
                        <td class="br bb" style="font-size: 12px;">Fecha Elab</td>
                        <td class="bb" style="font-size: 12px;"><?php echo date("d/m/Y", strtotime($columna['fec_elaboracion']))?></td>
                    </tr>
                    <tr>
                        <td class="br" style="font-size: 12px;">Fecha Rev</td>
                        <td style="font-size: 12px;"><?php echo date("d/m/Y", strtotime($columna['fec_revision']))?></td>
                    </tr>
                </tr>
            <?php 
                }
            ?>
            
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
            echo    "<table class='border' width='100%' style='padding:8px;'>
                        <thead>
                            <tr>
                                <td style='width:20%;'>N° Preventivo:</td>
                                <td style='width:50%;'>".$columna['id']."</td>
                                <td style='width:15%;'>Fecha Inicio:</td>
                                <td style='width:15%;'>".date("d/m/Y", strtotime($columna['fecha']))."</td>
                            </tr>
                            <tr>
                                <td>Responsable:</td>
                                <td>".$columna['responsable']."</td>
                                <td style='width:15%;'>Prioridad:</td>
                                <td style='width:15%;'>".$columna['prioridad']."</td>
                            </tr>
                            <tr>
                                <td>Tipo Mantenimiento:</td>
                                <td colspan='4'>".$columna['tipo_mantenimiento']."</td>
                            </tr>
                            <tr>
                                <td>Nombre Equipo:</td>
                                <td colspan='4'>".$columna['equipo']."</td>
                            </tr>
                        </thead>
                    </table>";
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

    <table width="100%" id="footer">
        <tr>
            <td style="width:50%;text-align:center;">___________________</td>
            <td style="width:50%;text-align:center;">___________________</td>
        </tr>
        <tr>
            <td style="width:50%;text-align:center;">Realizado Por</td>
            <td style="width:50%;text-align:center;">Verificado Por</td>
        </tr>
    </table>
</body>
</html>