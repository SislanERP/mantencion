<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $target_path = "../../../fichas_tecnicas/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $target = $target_path . basename( $_FILES['documento0']['name']);

    $consulta = "SELECT max(id_ficha) as correlativo FROM fichas_tecnicas";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }
    
    if(move_uploaded_file($_FILES['documento0']['tmp_name'], $target))
    {
        $query="INSERT INTO fichas_tecnicas (id_ficha,id_tipo_ficha,nombre,documento,uso,fec_registro,id_usuario_registro) values($contador,$_POST[tipo0],'$_POST[nombre0]','fichas_tecnicas/".$_FILES['documento0']['name']."','$_POST[uso0]','$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Ficha tecnica guardada satisfactoriamente.";
        }
    
        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }
    else{
        $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
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