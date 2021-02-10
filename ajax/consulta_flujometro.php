<?php
    session_start();
    require_once("../php/conexion.php");

    $consulta = "SELECT * FROM memorias WHERE id_plc = 1";
	$resultado = mysqli_query( conectar(), $consulta );
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        $consulta = "call consulta_plc($columna[id_registro])";
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
    }

    

?>