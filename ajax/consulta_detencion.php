<?php
    session_start();
    require_once("../php/conexion.php");
    
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['fecha'], ENT_QUOTES)));
    $_SESSION['fecha_detencion'] = $query;

    $consulta = "call consulta_encabezado_detencion('$query')";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr = array();
        $arr[0] = $columna['camiones'];
        $arr[1] = $columna['kilos_mm_pp'];
        $arr[2] = $columna['kilos_producidos'];
        $arr[3] = $columna['rendimiento'];
        $arr[4] = $columna['kilos_embolsado'];
        echo json_encode($arr);
    }
?>
