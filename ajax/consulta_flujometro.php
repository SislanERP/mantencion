<?php
    session_start();
    require_once("../php/conexion.php");

    $consulta = "call consulta_plc()";
	$resultado = mysqli_query( conectar(), $consulta );
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        echo "
            <div class='col-lg-4 col-sm-12 mb-4'>
                <h2 class='plc_titulo'>".$columna['nombre']."</h2>
                <h1 class='plc_valor'>".$columna['valor']."</h1>
            </div>
        ";
    }

?>