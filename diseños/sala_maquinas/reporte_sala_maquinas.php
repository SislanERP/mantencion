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
            <td class="p-0" rowspan="4" style="width:10%;vertical-align: inherit;"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
            <td class="text-center font-weight-bold p-0" rowspan="4" style="vertical-align: inherit; width:70%;"><h5>INSPECCIONES DIARIAS EQUIPOS FRIGORIFICOS SALA DE MAQUINAS <br>R14</br></h5></td>
            <td class="p-0 text-center" style="font-size: 12px;">Versión</td>
            <td class="p-0 text-center" style="font-size: 12px;">0.1</td>
            <tr>
            <td class="text-center p-0" style="font-size: 12px;" colspan="2">Página 1 de 1</td>
            </tr>
            <tr>
                <td class="text-center p-0" style="font-size: 12px;">Fecha Elaboración</td>
                <td class="text-center p-0" style="font-size: 12px;">23/01/2020</td>
            </tr>
        <tr>
        <td class="text-center p-0" style="font-size: 12px;">Fecha Revisión</td>
        <td class="text-center p-0" style="font-size: 12px;">23/01/2020</td>
    </table>

    <div>
        <span class="font-weight-bold" style="font-size:14px;">Fecha:</span>
        <span class="font-weight-bold" style="font-size:14px;"><?php $fecha = strtotime($_SESSION['fecha_caldera']);  echo date("d-m-Y",$fecha);?></span>
    </div>

    <table class="table table-bordered">
        <tr>
            <td class="p-2 text-center font-weight-bold" style="font-size:12px; vertical-align:inherit; width:120px;" class="text-center">EQUIPOS</td>
            <td class="p-2 text-center font-weight-bold" style="font-size:12px; vertical-align:inherit;" class="text-center">TEMPERATURA</td>
            <td class="p-2 text-center font-weight-bold" style="font-size:12px; vertical-align:inherit;" class="text-center">H. INICIO CONGELADO</td>
            <td class="p-2 text-center font-weight-bold" style="font-size:12px; vertical-align:inherit;" class="text-center">H.TERMINO CONGELADO</td>
        </tr>
        <?php
            $fecha = $_SESSION['fecha_control']; 
            $consulta = "call consulta_detalle_sala_maquinas('$fecha')";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            {
                $inicio = strtotime($columna['hora_inicio_c']);
                $termino = strtotime($columna['hora_termino_c']);
                echo "  <tr>
                            <td class='p-2 text-center' style='font-size:12px;'>".$columna['maquina']."</td>
                            <td class='p-2 text-center' style='font-size:12px;'>".$columna['temperatura']."</td>
                            <td class='p-2 text-center' style='font-size:12px;'>".date("H:i",$inicio)."</td>
                            <td class='p-2 text-center' style='font-size:12px;'>".date("H:i",$termino)."</td>
                        </tr>";
            }   
        ?>
    </table>

    <h3 class="font-weight-bold" style="font-size:12px;">OBSERVACIONES GENERALES</h3>
    <div style="border: 1px solid #dee2e6;width:100%;height:70px;">
        <?php
            $fecha = $_SESSION['fecha_control']; 
            $consulta = "call consulta_detalle_sala_maquinas('$fecha')";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            if ($columna = mysqli_fetch_array( $resultado ))
            {
                echo "<p style='font-size:12px;padding-left:10px;'>".$columna['observacion']."</p>";
            }   
        ?>
    </div>
    

    <div style="margin-top:20px;">
        <span style="font-size:12px;margin-left:80px;">REALIZADO POR:</span>
        <span style="font-size:12px;float:right;margin-right:10px;">APROBADO POR:</span>        
    </div>
    <div>
        <span class="font-weight-bold" style="font-size:12px;margin-left:80px;">
        <?php
            $fecha = $_SESSION['fecha_control']; 
            $consulta = "call consulta_detalle_sala_maquinas('$fecha')";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            if ($columna = mysqli_fetch_array( $resultado ))
            {
                echo $columna['usuario'];
            }    
        ?>          
        </span>
        <span style="float:right;margin-right:10px; position:absolute;bottom:8px;">
            <img src="../../../img/firmas/boris.png" alt="" style="width:200px;">
        </span>        
    </div>
</body>
</html>