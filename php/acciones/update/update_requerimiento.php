<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
    $target_path = "../../../img/requerimientos/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $id = $_POST['id-edit'];

    $consulta = "SELECT * FROM requerimientos where id_requerimiento=$id";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $imagen = "img/requerimientos/".$_FILES['imagen']['name'];
        if(empty($_FILES['imagen']['name']))
        {
            $query="UPDATE requerimientos SET actividad='$_POST[actividad]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_requerimiento=$id";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Requerimiento editado satisfactoriamente.";
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
                $query="UPDATE requerimientos SET actividad='$_POST[actividad]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_requerimiento=$id";
                if (conectar()->query($query) === TRUE) 
                {
                    $messages[] = "Requerimiento editado satisfactoriamente.";
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
                    $query="UPDATE requerimientos SET actividad='$_POST[actividad]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario, imagen='img/requerimientos/".$_FILES['imagen']['name']."' where id_requerimiento=$id";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "Requerimiento editado satisfactoriamente.";
                    }

                    else
                    {
                        $errors []= "3".mysqli_error(conectar());
                    }
                }
                else
                {
                    $query="UPDATE requerimientos SET actividad='$_POST[actividad]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario, imagen='img/requerimientos/".$_FILES['imagen']['name']."' where id_requerimiento=$id";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "Requerimiento editado satisfactoriamente.";
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