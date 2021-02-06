<?php
    session_start();
    require_once("../php/conexion.php");

    $consulta = "SELECT * FROM f_total_riles order by fecha desc limit 1";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr = array();
        $arr[0] = $columna['valor'];
    }

    echo json_encode($arr);
?>