<?php
    session_start();
	require_once("../php/conexion.php");
    
    $email = $_SESSION['email'];

    $consulta = "call consulta_login('$email')";
    $resultado = mysqli_query(conectar(), $consulta );
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        $arr = array();
        $arr[0] = $columna['nombre'];
        $arr[1] = $columna['email'];
        $arr[2] = $columna['direccion'];
        $arr[3] = $columna['telefono'];
        $arr[4] = $columna['imagen']; 
        $arr[5] = $columna['id_usuario'];
    }

    echo json_encode($arr);
?>

		