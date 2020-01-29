<?php
    session_start();
    include ('../../conexion.php');
    use PHPMailer\PHPMailer\PHPMailer;
    require '../../../vendor/autoload.php';

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    if($_POST['radio'] == 1){
        $query="UPDATE requerimientos SET id_prioridad=$_POST[prioridad1], id_trabajador=$_POST[responsable1], desarrollo='$_POST[desarrollo1]', id_estado=3,log_terminado=$_POST[radio],fec_edicion='$fecha',id_usuario_edicion='$id_usuario' where id_requerimiento=$_POST[id1]";
        if (conectar()->query($query) === TRUE) 
        {
            
        }
    
        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }
    else
    {
        $query="UPDATE requerimientos SET id_prioridad=$_POST[prioridad1], id_trabajador=$_POST[responsable1], desarrollo='$_POST[desarrollo1]', id_estado=$_POST[estado1],log_terminado=$_POST[radio],fec_edicion='$fecha',id_usuario_edicion='$id_usuario' where id_requerimiento=$_POST[id1]";
        if (conectar()->query($query) === TRUE) 
        {
            
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
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