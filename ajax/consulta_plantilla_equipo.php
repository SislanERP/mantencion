<?php
    session_start();
    require_once("../php/conexion.php");
    
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $equipo = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['equipo'], ENT_QUOTES)));

    $consulta = "call consulta_plantilla_equipo('$equipo')";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr = array();
        $arr[0] = $columna['detalle'];
        echo json_encode($arr);
    }
?>
