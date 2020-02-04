<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Actividades Diarias</title>
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

<body class="bl">
    <table id="header" border=1 cellspacing=0 cellpadding=2 width="100%" class="table">
        <tr>
            <td class="e1 e2" rowspan="4" width="12%"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
            <td class="e1 e2" width="58%" rowspan="4"><h1>TAREAS PROGRAMADAS</h1></td>
            <td class="e1 e2">Versión</td>
            <td class="e1 e2">0.1</td>
            <tr>
                <td colspan=2 class="e1 e2">Página 1 de 1</td>
            </tr>
            <tr>
                <td class="e1 e2" width="10%">Fecha Elab</td>
                <td width="10%" class="e1 e2">23/01/2020</td>
            </tr>
            <tr>
                <td class="e1 e2" width="12%">Fecha Rev</td>
                <td width="10%" class="e1 e2">23/01/2020</td>
            </tr>
        </tr>
    </table>

    <table border=1 cellspacing=0 cellpadding=2 width="100%" class="table" style="margin-top:-30px;">
        <tr>
            <td class="e1" style="font-weight:bolder;">Actividad</td>
            <td class="e1" style="font-weight:bolder;">Turno</td>
            <td class="e1" style="font-weight:bolder;">Estado</td>
        </tr>
        <?php
            $fec = $_SESSION['fecha_actividades'];
            $consulta = "call consulta_actividades('$fec')";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            {
                echo    "<tr>
                            <td>".$columna['actividad']."</td>
                            <td class='e1'>".$columna['turno']."</td>
                            <td class='e1'>".$columna['estado']."</td>
                        </tr>";
            }
        ?>
    </table>

    <div style="margin-top:20px;">
        <span style="font-size:14px;">Fecha:</span>
        <span style="font-size:14px;font-weight:bolder;"><?php $fecha = strtotime($_SESSION['fecha_actividades']); echo date("d-m-Y",$fecha);?></span>
    </div>

    <div id="footer">
        <img src='../../../img/firmas/boris.png' alt='' style='width:200px;position:absolute;right:0px;margin-top:-110px;'>
        <span style="float:right;">Jefe de Mantención</span>
    </div>
</body>
</html>