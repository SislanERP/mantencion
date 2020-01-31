<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $target_path = "../../../img/no_conformidades/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $consulta = "SELECT * FROM no_conformidades where id_no_conformidad=$_POST[id]";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $imagen = "img/no_conformidades/".$_FILES['imagen']['name'];
        if(empty($_FILES['imagen']['name']))
        {
            $query="UPDATE no_conformidades SET fecha='$_POST[fecha]', id_area=$_POST[area],id_producto=$_POST[producto], id_fase=$_POST[fase], id_personal=$_POST[detector], descripcion='$_POST[desviacion]',fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_no_conformidad=$_POST[id]";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "No Conformidad editada satisfactoriamente.";
            }

            else
            {
                $errors []= "".mysqli_error(conectar());
            }
        }
        else
        {
            if($columna['img_antes'] == $imagen)
            {
                $query="UPDATE no_conformidades SET fecha='$_POST[fecha]', id_area=$_POST[area],id_producto=$_POST[producto], id_fase=$_POST[fase], id_personal=$_POST[detector], descripcion='$_POST[desviacion]',fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_no_conformidad=$_POST[id]";
                if (conectar()->query($query) === TRUE) 
                {
                    $messages[] = "No Conformidad editada satisfactoriamente.";
                }

                else
                {
                    $errors []= "".mysqli_error(conectar());
                }
            }
            else
            {
                $target = $target_path . basename( $_FILES['imagen']['name']);
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
                {
                    $query="UPDATE no_conformidades SET fecha='$_POST[fecha]', id_area=$_POST[area],id_producto=$_POST[producto], id_fase=$_POST[fase], id_personal=$_POST[detector], descripcion='$_POST[desviacion]',fec_edicion='$fecha',id_usuario_edicion=$id_usuario, img_antes='img/no_conformidades/".$_FILES['imagen']['name']."' where id_no_conformidad=$_POST[id]";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "No Conformidad editada satisfactoriamente.";
                    }

                    else
                    {
                        $errors []= "".mysqli_error(conectar());
                    }
                }
                else
                {
                    $query="UPDATE no_conformidades SET fecha='$_POST[fecha]', id_area=$_POST[area],id_producto=$_POST[producto], id_fase=$_POST[fase], id_personal=$_POST[detector], descripcion='$_POST[desviacion]',fec_edicion='$fecha',id_usuario_edicion=$id_usuario, img_antes='img/no_conformidades/".$_FILES['imagen']['name']."' where id_no_conformidad=$_POST[id]";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "No Conformidad editada satisfactoriamente.";
                    }

                    else
                    {
                        $errors []= "".mysqli_error(conectar());
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