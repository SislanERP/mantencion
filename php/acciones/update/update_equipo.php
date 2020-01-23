<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
    $target_path = "../../../img/equipos/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $consulta = "SELECT * FROM equipos where id_equipo=$_POST[id]";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $imagen = "img/equipos/".$_FILES['imagen']['name'];
        if(empty($_FILES['imagen']['name']))
        {
            $query="UPDATE equipos SET equipo='$_POST[nombre]',marca='$_POST[marca]',id_ubicacion=$_POST[ubicacion],id_linea=$_POST[linea],caracteristicas='$_POST[caracteristicas]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_equipo=$_POST[id]";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Equipo editado satisfactoriamente.";
            }

            else
            {
                $errors []= "1".mysqli_error(conectar());
            }
        }
        else
        {
            if($columna['imagen'] == $imagen)
            {
                $query="UPDATE equipos SET equipo='$_POST[nombre]',marca='$_POST[marca]',id_ubicacion=$_POST[ubicacion],id_linea=$_POST[linea],caracteristicas='$_POST[caracteristicas]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_equipo=$_POST[id]";
                if (conectar()->query($query) === TRUE) 
                {
                    $messages[] = "Equipo editado satisfactoriamente.";
                }

                else
                {
                    $errors []= "2".mysqli_error(conectar());
                }
            }
            else
            {
                $target = $target_path . basename( $_FILES['imagen']['name']);
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
                {
                    $query="UPDATE equipos SET equipo='$_POST[nombre]',marca='$_POST[marca]',id_ubicacion=$_POST[ubicacion],id_linea=$_POST[linea],caracteristicas='$_POST[caracteristicas]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario, imagen='img/equipos/".$_FILES['imagen']['name']."' where id_equipo=$_POST[id]";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "Equipo editado satisfactoriamente.";
                    }

                    else
                    {
                        $errors []= "3".mysqli_error(conectar());
                    }
                }
                else
                {
                    $query="UPDATE equipos SET equipo='$_POST[nombre]',marca='$_POST[marca]',id_ubicacion=$_POST[ubicacion],id_linea=$_POST[linea],caracteristicas='$_POST[caracteristicas]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario, imagen='img/equipos/".$_FILES['imagen']['name']."' where id_equipo=$_POST[id]";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "Equipo editado satisfactoriamente.";
                    }

                    else
                    {
                        $errors []= "4".mysqli_error(conectar());
                    }
                }
                
            }
        }
    }

    if (isset($errors)){
			
        ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> 
                    <?php
                        foreach ($errors as $error) {
                                echo $error;
                            }
                        ?>
            </div>
            <?php
            }
            if (isset($messages)){
                
                ?>
                <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Bien hecho!</strong>
                        <?php
                            foreach ($messages as $message) {
                                    echo $message;
                                }
                            ?>
                </div>
                <?php
            }
    
?>