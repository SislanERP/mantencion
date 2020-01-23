<?php
    session_start();
    include ('../../conexion.php');

    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $id_usuario = $_SESSION['id_user'];
    
    $query="UPDATE detalle_detencion SET id_tipo_falla=$_POST[tipo], id_equipo=$_POST[equipo], descripcion='$_POST[descripcion]', hora_falla='$_POST[falla]', tiempo='$_POST[tiempo]', detencion_proceso=$_POST[detencion_proceso],fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_registro=$_POST[id]";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Detención actualizada satisfactoriamente.";
    }

    else
    {
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