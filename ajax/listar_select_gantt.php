<?php
    session_start();
    require_once("../php/conexion.php");

    $id = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

    $consulta = "SELECT * FROM equipos WHERE id_ubicacion = $id";
	$resultado = mysqli_query( conectar(), $consulta );
    ?>
    <select name="list_equi" id="list_equi" class="form-control" data-live-search="true">
                                        
    <?php
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        echo   "<option value='".$columna['id_equipo']."'>".$columna['equipo']."</option>";
    }
?></select>
