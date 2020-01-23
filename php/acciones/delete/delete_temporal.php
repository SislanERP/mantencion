<?php 
    session_start();
    include ('../../conexion.php');
		
	$sql="DELETE FROM temporal";
	$query_delete = mysqli_query(conectar(),$sql);
	if ($query_delete){
	}
?>