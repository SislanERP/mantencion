<?php
	require_once("../php/conexion.php");
	session_start();
    $contador = 0;

    $query = mysqli_query(conectar(),"CALL listar_detenciones");
    $arr = array();

    while($row = mysqli_fetch_array($query)){
        $arr[$contador] = $row;
        $contador++;
    } 

    echo json_encode($arr);
?>