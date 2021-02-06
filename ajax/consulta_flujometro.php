<?php
    session_start();
    require_once("../php/conexion.php");

    $consulta = "call consulta_plc()";
	$resultado = mysqli_query( conectar(), $consulta );
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        echo "
            <div class=''>
                <h1 class=''>".$columna['nombre']."</h1>
                <h1 class=''>".$columna['valor']."</h1>
            </div>
        ";
    }

?>