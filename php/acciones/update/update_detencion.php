<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    if($_POST['camiones'] == ""){$camiones=0;}else{$camiones=$_POST['camiones'];}
    if($_POST['kilos_mm_pp'] == ""){$kilos_mm_pp=0;}else{$kilos_mm_pp=$_POST['kilos_mm_pp'];}
    if($_POST['kilos_producidos'] == ""){$kilos_producidos=0;}else{$kilos_producidos=$_POST['kilos_producidos'];}
    if($_POST['rendimiento'] == ""){$rendimiento=0;}else{$rendimiento=$_POST['rendimiento'];}
    if($_POST['kilos_embolsado'] == ""){$kilos_embolsado=0;}else{$kilos_embolsado=$_POST['kilos_embolsado'];}
    
    $query="UPDATE detenciones SET camiones=$camiones, kilos_mm_pp=$kilos_mm_pp,kilos_producidos=$kilos_producidos, rendimiento=$rendimiento, kilos_embolsado=$kilos_embolsado,fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_detencion=$_POST[id]";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "La detención ha sido editada satisfactoriamente.";
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