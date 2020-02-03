<?php
    session_start();
    require_once("../php/conexion.php");

    $equipo = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['equipo'], ENT_QUOTES)));

    $consulta = "call consulta_plantilla_equipo($equipo)";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr = array();
        $arr[0] = $columna['detalle'];
        echo json_encode($arr);
    }
?>
