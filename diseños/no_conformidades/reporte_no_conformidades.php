<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte No Conformidad</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
    <style>
       @page { margin: 180px 50px; }
       #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center; }
       #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
       #footer .page:after { content: counter(page, upper-roman); }
     </style>
    <style>
       #firma { position: fixed; left: 0px; bottom: 150px; right: 0px; text-align: center;}
     </style>
</head>

<?php
    $id = $_GET["id"];
    $consulta = "call  consulta_no_conformidades($id)";
    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    while ($columna = mysqli_fetch_array( $resultado ))
    {
        $fecha = $columna['fecha'];
        $area = $columna['area'];
        $producto = $columna['producto'];
        $fase = $columna['fase'];
        $detector = $columna['detector'];
        $desviacion = $columna['desviacion'];
        $correctivo = $columna['correctivo'];
        $preventivo = $columna['preventivo'];
        $consecuencia = $columna['consecuencia'];
        $observaciones = $columna['observaciones'];
        $responsable = $columna['responsable'];
        $fec_verificacion = $columna['fec_verificacion'];
        $usuario_verificacion = $columna['usuario_verificacion'];
        $fec_ejecucion = $columna['fec_ejecucion'];
        $id_usuario_verificacion = $columna['id_usuario_verificacion'];
        $img_antes = $columna['img_antes'];
        $img_despues = $columna['img_despues'];
    }
?>

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
    <table id="header" class="table table-bordered">
        <thead>
            <tr>
                <td  rowspan="4" class="p-1" style="width:10%;vertical-align: inherit;"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
                <td rowspan="4" class="text-center p-1" style="vertical-align: inherit; width:62%;"><h6>REGISTRO DE NO CONFORMIDADES INTERNAS<br>R57   </br></h6></td>
                <td class="text-center p-1" style="font-size: 11px;">Versión</td>
                <td class="text-center p-1" style="font-size: 11px;">08</td>
                <tr>
                    <td class="text-center p-1" colspan="2" style="font-size: 11px;height:18px;"></td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 11px;">Fecha Elab</td>
                    <td class="text-center p-1" style="font-size: 11px;">12/10/2011</td>
                </tr>
                <tr>
                    <td class="text-center p-1" style="font-size: 11px;">Fecha Rev</td>
                    <td class="text-center p-1" style="font-size: 11px;">10/06/2019</td>
                </tr>
            </tr>
        <thead>
    </table>

    <table class="table table-bordered " style="margin-top: -30px;">
        <tr>
            <td colspan="1" class="p-1" style="font-size: 11px;width:110px;">Fecha</td>
            <td class="p-1" style="font-size: 11px;" colspan="3"><?php echo date("d-m-Y",strtotime($fecha));?></td>
        </tr>
        <tr>
            <td class="p-1" colspan="1" style="font-size: 11px;">Área o departamento</td>
            <td class="p-1" style="font-size: 11px;" colspan="2"><?php echo $area;?></td>
            <td class="p-1" style="font-size: 11px;" colspan="1">NC: <?php echo $id;?></td>
        </tr>
        <tr>
            <td class="p-1" colspan="1" style="font-size: 11px;">Producto</td>
            <td class="p-1" style="font-size: 11px;" colspan="3"><?php echo $producto;?></td>
        </tr>
        <tr>
            <td class="p-1" colspan="1" style="font-size: 11px;">Fase del proceso</td>
            <td class="p-1" style="font-size: 11px;" colspan="3"><?php echo $fase;?></td>
        </tr>
        <tr>
            <td class="p-1" colspan="1" style="font-size: 11px;">Detectado por</td>
            <td class="p-1" style="font-size: 11px;" colspan="3"><?php echo $detector;?></td>
        </tr>
    </table>
    <div id="footer" class="w-100 mt-3 text-center">
        <em style="font-size:9px;">Soc. Pesquera Landes S.A. - Secotr Astillero Rural - Dalcahue, Décima Región - CHILE.</em>
    </div>

    <div>
        <table class="w-100">
            <tr>
                <td class="border text-center" style="background:#F8F5F5;" style="font-size: 12px;">DESCRIPCIÓN:</td>
            </tr>
            <td class="border p-1" style="font-size: 11px; height:110px;"><?php echo $desviacion;?></td>
        </table>

        <table class="w-100 mt-3">
            <tr>
                <td class="border text-center" style="background:#F8F5F5;" style="font-size: 12px;">CAUSA RAIZ - CONSECUENCIA</td>
            </tr>
            <td class="border p-1" style="font-size: 11px; height:110px;"><?php echo $consecuencia;?></td>
        </table>

        <table class="w-100 mt-3">
            <tr>
                <td class="border text-center" style="background:#F8F5F5;" style="font-size: 12px;">ACCIONES CORRECTIVAS</td>
            </tr>
            <td class="border p-1" style="font-size: 11px; height:110px;"><?php echo $correctivo;?></td>
        </table>

        <table class="w-100 mt-3">
            <tr>
                <td class="border text-center" style="background:#F8F5F5;" style="font-size: 12px;">ACCIONES PREVENTIVA</td>
            </tr>
            <td class="border p-1" style="font-size: 11px; height:110px;"><?php echo $preventivo;?></td>
        </table>
    </div>
    <div>
        

        <table class="w-100 mt-1">
            <tr>
                <td class="border text-center" style="background:#F8F5F5;" style="font-size: 12px;">SEGUIMIENTO / OBSERVACIONES</td>
            </tr>
            <td class="border p-1" style="font-size: 11px; height:130px;">
                <?php 
                    echo "<p class='mb-5'>".$observaciones."</p>";
                ?>
                <div class="mt-5 d-flex w-100">
                    <div><?php echo "<img src='../../../".$img_antes."' style='width:280px;margin-left:50px;'/></br>";?></div>
                    <div><?php echo "<img src='../../../".$img_despues."' style='width:280px;float:right;margin-right:50px;'/></br>";?></div>
                </div>
            </td>
        </table>

        <table class="w-100 mt-3">
            <tr>
                <td class="p-1 border" colspan="1" style="font-size: 11px;width:150px;">Responsable de la ejecución</td>
                <td class="p-1 border" colspan="1" style="font-size: 11px;width:310px;"><?php echo $responsable;?></td>
                <td class="p-1 border" colspan="1" style="font-size: 11px;width:110px;">Fecha de ejecución</td>
                <td class="p-1 border" colspan="1" style="font-size: 11px;"><?php echo date("d-m-Y",strtotime($fec_ejecucion));?></td>/
            </tr>
            <tr>
                <td class="p-1 border" colspan="1" style="font-size: 11px;width:150px;">Responsable de la verificación</td>
                <td class="p-1 border" colspan="1" style="font-size: 11px;width:310px;"><?php echo $usuario_verificacion;?></td>
                <td class="p-1 border" colspan="1" style="font-size: 11px;width:110px;">Fecha de verificación</td>
                <?php 
                    $consulta = "select * from usuarios where id_usuario=".$id_usuario_verificacion;
                    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado ))
                    {
                        $firma = $columna['firma'];
                    }
                ?>
                <span id="firma" style="font-size:12px;margin-right:10px;">
                    <img src="../../../<?php echo $firma;?>" alt="" style="width:130px;margin-top:-30px;">
                </span>        
                <td class="p-1 border" colspan="1" style="font-size: 11px;"><?php echo date("d-m-Y",strtotime($fec_verificacion));?></td>/
            </tr>
        </table>
    </div>
    
</body>
</html>