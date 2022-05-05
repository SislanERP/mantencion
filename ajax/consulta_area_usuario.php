<?php
    session_start();
	require_once("../php/conexion.php");
    $id_usuario = $_SESSION['id_user'];

    $consulta = "call consulta_area_usuario($id_usuario)";
    $resultado = mysqli_query(conectar(), $consulta );
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        echo $columna['id_area'];
    }
?>

		