<!DOCTYPE html>
<head>
    <title>Resumen Requerimientos</title>
    <style>
        @page { margin-top: 180px;margin-bottom: 180px; margin-left:50px; }
        #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
        #footer .page:after { content: counter(page, upper-roman); }
        .e1{padding:8px;}
        .e2{font-size:11px;}
        .table td {border: 1px solid #dee2e6;}
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
            $y = 53;
            $x = 690;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}
</script> 
    <table id="header" border=1 cellspacing=0 cellpadding=2 width="100%" class="table">
        <tr>
            <td class="e1 e2" rowspan="4" width="12%"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
            <td class="e1 e2" width="58%" rowspan="4"><h1>RESUMEN REQUERIMIENTOS</h1></td>
            <td class="e1 e2">Versión</td>
            <td class="e1 e2">0.2</td>
            <tr>
                <td colspan=2 class="e1 e2"></td>
            </tr>
            <tr>
                <td class="e1 e2" width="10%">Fecha Elab</td>
                <td width="10%" class="e1 e2">29/01/2020</td>
            </tr>
            <tr>
                <td class="e1 e2" width="12%">Fecha Rev</td>
                <td width="10%" class="e1 e2">02/02/2021</td>
            </tr>
        </tr>
    </table>
    <div id="footer" style="width:100%;text-align:center;">
        <em style="font-size:9px;">Soc. Pesquera Landes S.A. - Secotr Astillero Rural - Dalcahue, Décima Región - CHILE.</em>
    </div>
    <table border=1 cellspacing=0 cellpadding=2 width="100%" class="table">
        <tr>
            <td class="e1" style="text-align:center;">N°</td>
            <td class="e1" style="text-align:center;">Fecha</td>
            <td class="e1" style="text-align:center;">Descripción</td>
            <td class="e1" style="text-align:center;">Estado</td>
            <td class="e1" style="text-align:center;">Detectado Por</td>
            <td class="e1" style="text-align:center;">Terminado?</td>
        </tr>
        <?php
            $consulta = "call consulta_resumen_requerimientos()";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
        ?>
                    <tr>
                        <td class="e1"><?php echo $columna['id'];?></td>
                        <td class="e1"><?php echo date("d/m/Y", strtotime($columna['fecha']));?></td>
                        <td class="e1"><?php echo $columna['actividad'];?></td>
                        <td class="e1"><?php echo $columna['estado'];?></td>
                        <td class="e1"><?php echo $columna['detectado'];?></td>
                        <td class="e1">NO</td>
                    </tr>
        <?php   
            }
        ?>
    </table>
    
</body>
</html>