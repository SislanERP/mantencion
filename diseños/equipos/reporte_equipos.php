<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
    <title>Listado de equipos</title>
</head>

<body class="bl">
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