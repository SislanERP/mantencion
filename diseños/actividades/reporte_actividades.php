<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Correctivo</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
</head>

<body class="bl">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <td class="p-1" style="width:10%;vertical-align: inherit;"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
                <td class="text-center font-weight-bold p-1" style="vertical-align: inherit; width:80%;"><h3>TAREAS PROGRAMADAS</h3></td>
            </tr>
        <thead>
    </table>

    <div><span>Fecha: <b><?php $fecha = strtotime($_SESSION['fecha_actividades']); echo date("d-m-Y",$fecha);?></b></span></div>

    <table class="table table-bordered mt-2">
        <tr>
            <td class="p-1 text-center font-weight-bold">Actividad</td>
            <td class="p-1 text-center font-weight-bold">Turno</td>
            <td class="p-1 text-center font-weight-bold">Estado</td>
        </tr>
        <?php
            $fec = $_SESSION['fecha_actividades'];
            $consulta = "call consulta_actividades('$fec')";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            {
                echo    "<tr>
                            <td class='p-1'>".$columna['actividad']."</td>
                            <td class='p-1 text-center'>".$columna['turno']."</td>
                            <td class='p-1 text-center'>".$columna['estado']."</td>
                        </tr>";
            }
        ?>
    </table>
    <div class="w-100 d-flex flex-column">
        <img src='../../../img/firmas/boris.png' alt='' style='width:200px;position:absolute;top:840px;left:240px;'>
        <span class="w-100 text-center" style="position:absolute;bottom:50px;">Jefe de Mantención</span>
    </div>
</body>
</html>