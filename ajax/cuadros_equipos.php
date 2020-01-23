<?php
    session_start();
	require_once("../php/conexion.php");

    $consulta = "call consulta_cuadros_producto()";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr = array();
        $arr[0] = $columna['Cantidad'];
        echo json_encode($arr);
    }
?>

		  