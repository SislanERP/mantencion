<?php
    session_start();
    require_once("../php/conexion.php");
    
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['fecha'], ENT_QUOTES)));
    $_SESSION['fecha_caldera'] = $query;

    $consulta = "call consulta_encabezado_caldera('$query')";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr = array();
        $encendido = strtotime($columna['hora_encendido']);
        $apagado = strtotime($columna['hora_apagado']);
        $arr[0] = date("H:i",$encendido);
        $arr[1] = date("H:i",$apagado);
        $arr[2] = $columna['observacion'];
        echo json_encode($arr);
    }
?>
