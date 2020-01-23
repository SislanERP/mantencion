<?php
    session_start();
    include ('../../conexion.php');
    
    if(empty($_POST["año"])){$año="NULL";}else{$año=$_POST["año"];}
    if(empty($_POST["rut"])){$rut="";}else{$rut=$_POST["rut"];}
    if(empty($_POST["telefono"])){$telefono="";}else{$telefono=$_POST["telefono"];}
    if(empty($_POST['email'])){$email="";}else{$email=$_POST['email'];}

    //echo "<script>alert('".$_POST['email']."');</script>";

    $query="UPDATE vehiculos SET patente='$_POST[patente]',marca='$_POST[marca]', modelo='$_POST[modelo]', año=$año, rut='$rut', nombre='$_POST[nombre]', telefono='$telefono', email='$email' where id_vehiculo=$_POST[id]";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Los datos del vehiculo han sido editados satisfactoriamente.";
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