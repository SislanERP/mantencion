<?php
    session_start();
    require_once("../php/conexion.php");

    $consulta = "SELECT * FROM memorias WHERE id_plc = 1";
	$resultado = mysqli_query( conectar(), $consulta );
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        $consulta1 = "call consulta_plc($columna[id_registro])";
        $resultado1 = mysqli_query( conectar(), $consulta1 );
        if ($columna1 = mysqli_fetch_array( $resultado1 ))
        {
            echo "
                <div class='col-lg-4 col-sm-12 mb-4'>
                    <h2 class='plc_titulo'>".$columna1['nombre']."</h2>
                    <h1 class='plc_valor'>".$columna1['valor']." ".$columna1['simbologia']."</h1>
                </div>
            ";
        }
    }

    

?>