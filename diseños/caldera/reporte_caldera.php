<?php
    $fecha = $_SESSION['fecha_caldera']; 
    $consulta = "call consulta_encabezado_caldera('$fecha')";
    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        $encendido = strtotime($columna['hora_encendido']);
        $apagado = strtotime($columna['hora_apagado']);
        $observacion = $columna['observacion'];
        $responsable = $columna['nombre'];
    }    
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Caldera</title>
    <style>
        @page { margin-top: 180px;margin-bottom: 180px; margin-left:50px; }
        #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
        #footer .page:after { content: counter(page, upper-roman); }
        .e1{padding:5px;text-align:center;}
        .e2{font-size:11px;}
        .table td {border: 1px solid #dee2e6;}
    </style>
</head>
<body>
    <table id="header" border=1 cellspacing=0 cellpadding=2 width="100%" class="table">
        <tr>
            <td class="e1 e2" rowspan="4" width="12%"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
            <td class="e1 e2" width="58%" rowspan="4"><h1>HOJA DE CONTROL R15</h1></td>
            <td class="e1 e2">Versión</td>
            <td class="e1 e2">0.2</td>
            <tr>
                <td colspan=2 class="e1 e2">Página 1 de 1</td>
            </tr>
            <tr>
                <td class="e1 e2" width="10%">Fecha Elab</td>
                <td width="10%" class="e1 e2">23/01/2020</td>
            </tr>
            <tr>
                <td class="e1 e2" width="12%">Fecha Rev</td>
                <td width="10%" class="e1 e2">02/02/2021</td>
            </tr>
        </tr>
        <tr>
            <td class="e1" style="font-size:13px;" colspan=1>TÍTULO</td>
            <td colspan="3" class="e1" style="font-size:13px;">PLANILLA DE INSPECCIONES DIARIAS CENTRAL GENERADORA DE VAPOR (CALDERAS)</td>
        </tr>
    </table>

    <table border=1 cellspacing=0 cellpadding=2 width="100%" class="table">
        <tr>
            <td class="e1 e2" width="15%" style="font-weight:bolder;">EQUIPOS</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">PURGAS DE VAPOR</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">REVISION INSTRUMENTOS DE MEDIDA</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">REVISION BOMBAS DE AGUA</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">MEDICION ESTANQUES DE GAS</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">PRESION DE TRABAJO</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">H ENCENDIDO</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">H APAGADO</td>
        </tr>
        <tr>
            <td class="e1 e2">CALDERA N° 1</td>
            <td class="e1 e2"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;"></td>
            <td class="e1 e2">7,5</td>
            <td class="e1 e2"><?php echo date("H:i",$encendido);?></td>
            <td class="e1 e2"><?php echo date("H:i",$apagado);?></td>
        </tr>
        <tr>
            <td class="e1 e2">CALDERA N° 2</td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
        </tr>
        <tr>
            <td class="e1 e2">CALDERA N° 3</td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
            <td class="e1 e2"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;"></td>
        </tr>
    </table>

    <h3 style="font-size:12px;margin-top:30px;">OBSERVACIONES GENERALES</h3>
    <div style="border: 1px solid #dee2e6;width:100%;height:300px;padding:10px;font-size:12px;">
        <?php echo $observacion;?>
    </div>
    <div style="margin-top:20px;">
        <span class="font-weight-bold" style="font-size:14px;">Fecha:</span>
        <span class="font-weight-bold" style="font-size:14px;font-weight:bolder;"><?php $fecha = strtotime($_SESSION['fecha_caldera']);  echo date("d-m-Y",$fecha);?></span>
    </div>

    <div id="footer">
        <div>
            <span style="font-size:14px;font-weight:bolder;">
                <?php echo $responsable;?>          
            </span>
        </div>
        <div>
            <span style="font-size:12px;">Operador</span>
            <span style="font-size:12px;float:right;margin-right:10px;">Aprobado por Jefe de mantención:</span>        
        </div>
        <div>
            <span style="float:right;margin-right:10px;margin-top:-130px;">
                <img src="../../../img/firmas/boris.png" alt="" style="width:200px;">
            </span>        
        </div>
    </div>
<body>
</html>