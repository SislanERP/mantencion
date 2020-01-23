<?php
    session_start();
    require_once("../php/conexion.php");
    
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['fecha'], ENT_QUOTES)));
    $_SESSION['fecha_control'] = $query;

    $consulta = "call consulta_encabezado_sala_maquinas('$query')";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr = array();
        $arr[0] = $columna['observacion'];
        echo json_encode($arr);
    }
?>
