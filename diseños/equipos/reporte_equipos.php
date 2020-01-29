<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
    <title>Listado de equipos</title>
    <style>
       @page { margin: 180px 50px; }
       #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center; }
       #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; }
       #footer .page:after { content: counter(page, upper-roman); }
     </style>
     
</head>

<body class="bl">
<script type="text/php">
    if ( isset($pdf) ) { 
        $pdf->page_script('
        if ($PAGE_COUNT > 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 9;
            $pageText = "Página " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 48;
            $x = 480;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}
</script> 
    <table id="header" class="table table-bordered ">
        <thead>
            <tr>
                <td  rowspan="4" class="p-1" style="width:10%;vertical-align: inherit;"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
                <td rowspan="4" class="text-center p-1" style="vertical-align: inherit; width:62%;"><h6>LISTADO DE EQUIPOS PLANTA<br>D55   </br></h6></td>
                <td class="text-center p-1" style="font-size: 11px;">Versión</td>
                <td class="text-center p-1" style="font-size: 11px;">01</td>
                <tr>
                    <td class="text-center p-1" colspan="2" style="font-size: 11px;height:18px;"></td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 11px;">Fecha Elab</td>
                    <td class="text-center p-1" style="font-size: 11px;">29/01/2020</td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 11px;">Fecha Rev</td>
                    <td class="text-center p-1" style="font-size: 11px;">29/01/2020</td>
                </tr>
            </tr>
        <thead>
    </table>
    <table class="table tab table-bordered tab-cot">
        <tr>
            <th>Nombre</th>
        </tr>
        <?php
            $consulta = "call consulta_equipos()";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
        ?>
                    <tr>
                        <td class="bor p-1"><?php echo $columna['equipo'];?></td>
                    </tr>
        <?php   
            }
        ?>
    </table>
</body>
</html>