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
            <td class="e1 e2" width="58%" rowspan="4"><h1>INSPECCIONES DIARIAS EQUIPOS FRIGORIFICOS SALA DE MAQUINAS R14</h1></td>
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
    </table>

    <table border=1 cellspacing=0 cellpadding=2 width="100%" class="table" style="margin-top:20px">
        <tr>
            <td class="e1 e2" width="15%" style="font-weight:bolder;">EQUIPOS</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">TEMPERATURA</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">H. INICIO CONGELADO</td>
            <td class="e1 e2" width="12%" style="font-weight:bolder;">H. TERMINO CONGELADO</td>
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
                            <td class='e1 e2' style='font-size:12px;'>".$columna['maquina']."</td>
                            <td class='e1 e2' style='font-size:12px;'>".$columna['temperatura']."</td>
                            <td class='e1 e2' style='font-size:12px;'>".date("H:i",$inicio)."</td>
                            <td class='e1 e2' style='font-size:12px;'>".date("H:i",$termino)."</td>
                        </tr>";
            }   
        ?>
    </table>

    <h3 class="" style="font-size:12px;">OBSERVACIONES GENERALES</h3>
    <div style="border: 1px solid #dee2e6;width:100%;height:300px;">
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
        <span class="font-weight-bold" style="font-size:14px;">Fecha:</span>
        <span class="font-weight-bold" style="font-size:14px;font-weight:bolder;"><?php $fecha = strtotime($_SESSION['fecha_control']);  echo date("d-m-Y",$fecha);?></span>
    </div>

    <div id="footer">
        <div>
            <span style="font-size:14px;font-weight:bolder;">
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