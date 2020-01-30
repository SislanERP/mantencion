<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Caldera</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
</head>

<body class="bl">
    <table class="table table-bordered ">
        <tr>
            <td class="p-1" rowspan="4" style="width:10%;vertical-align: inherit;"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
            <td class="text-center font-weight-bold p-1" rowspan="4" style="vertical-align: inherit; width:55%;"><h3>HOJA DE CONTROL <br>R15</br></h3></td>
            <td class="p-1 text-center" style="font-size: 12px;">Versión</td>
            <td class="p-1 text-center" style="font-size: 12px;">0.1</td>
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
        <tr>
        
        <td class="text-center p-1" style="font-size: 12px;">TÍTULO</td>
        <td class="text-center p-1 font-weight-bold" colspan="3" style="font-size: 12px;">PLANILLA DE INSPECCIONES DIARIAS CENTRAL GENERADORA DE VAPOR (CALDERAS)</td>
            
    </table>

    <table class="table table-bordered">
        <tr>
            <td style="font-size:10px; vertical-align:inherit; width:70px;" class="text-center">EQUIPOS</td>
            <td style="font-size:10px; vertical-align:inherit;" class="text-center">PURGAS DE VAPOR</td>
            <td style="font-size:10px; vertical-align:inherit;" class="text-center">REVISION INSTRUMENTOS DE MEDIDA</td>
            <td style="font-size:10px; vertical-align:inherit;" class="text-center">REVISION BOMBAS DE AGUA</td>
            <td style="font-size:10px; vertical-align:inherit;" class="text-center">MEDICION ESTANQUES DE GAS</td>
            <td style="font-size:10px; vertical-align:inherit;" class="text-center">PRESION DE TRABAJO</td>
            <td style="font-size:10px; vertical-align:inherit;" class="text-center">H ENCENDIDO</td>
            <td style="font-size:10px; vertical-align:inherit;" class="text-center">H APAGADO</td>
        </tr>
        <tr>
            <td style="font-size:10px;width:100%">CALDERA N° 1</td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/verificado.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td class="text-center" style="font-size:12px;width:100%">7,5</td>
            <td class="text-center W-100" style="font-size:12px;width:100%">
                <?php
                    $fecha = $_SESSION['fecha_caldera']; 
                    $consulta = "call consulta_encabezado_caldera('$fecha')";
                    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado ))
                    {
                        $encendido = strtotime($columna['hora_encendido']);
                        echo date("H:i",$encendido);
                    }    
                ?>
            </td>
            <td class="text-center" style="font-size:12px;width:100%">
                <?php
                    $fecha = $_SESSION['fecha_caldera']; 
                    $consulta = "call consulta_encabezado_caldera('$fecha')";
                    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado ))
                    {
                        $apagado = strtotime($columna['hora_apagado']);
                        echo date("H:i",$apagado);
                    }    
                ?>
            </td>
        </tr>
        <tr>
            <td style="font-size:10px;width:100%">CALDERA N° 2</td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:12px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:12px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:12px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
        </tr>
        <tr>
            <td style="font-size:10px;width:100%">CALDERA N° 3</td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:10px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:12px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:12px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
            <td style="font-size:12px;width:100%"><img src="../../../img/iconos/fuera_servicio.png" alt="" style="width:18px;margin-left:20px;"></td>
        </tr>
    </table>

    <h3 class="font-weight-bold" style="font-size:12px;">OBSERVACIONES GENERALES</h3>
    <div style="border: 1px solid #dee2e6;width:100%;height:300px;">
        <?php
            $fecha = $_SESSION['fecha_caldera']; 
            $consulta = "call consulta_encabezado_caldera('$fecha')";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            if ($columna = mysqli_fetch_array( $resultado ))
            {
                echo "<p class='p-1' style='font-size:12px;'>".$columna['observacion']."</p>";
            }    
        ?>
    </div>
    <div>
        <span class="font-weight-bold" style="font-size:14px;">Fecha:</span>
        <span class="font-weight-bold" style="font-size:14px;"><?php $fecha = strtotime($_SESSION['fecha_caldera']);  echo date("d-m-Y",$fecha);?></span>
    </div>

    <div style="margin-top:90px;">
        <span style="font-size:12px;margin-left:80px;">Operador:</span>
        <span style="font-size:12px;float:right;margin-right:10px;">Aprobado por Jefe de mantención:</span>        
    </div>
    <div>
        <span class="font-weight-bold" style="font-size:12px;margin-left:80px;">
        <?php
            $fecha = $_SESSION['fecha_caldera']; 
            $consulta = "call consulta_encabezado_caldera('$fecha')";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            if ($columna = mysqli_fetch_array( $resultado ))
            {
                echo $columna['nombre'];
            }    
        ?>          
        </span>
        <span style="font-size:12px;float:right;margin-right:10px;">
        <img src="../../../img/firmas/boris.png" alt="" style="width:200px;">
        </span>        
    </div>
</body>
</html>