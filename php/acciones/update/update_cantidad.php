<?php
    session_start();
    include ('../../conexion.php');

    $query="UPDATE temporal SET cantidad=$_POST[cantidad] WHERE id_registro=$_POST[id]";
    if (conectar()->query($query) === TRUE) 
    {  
    }
?>