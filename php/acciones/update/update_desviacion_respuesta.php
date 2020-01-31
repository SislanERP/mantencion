<?php
    session_start();
    include ('../../conexion.php');
    use PHPMailer\PHPMailer\PHPMailer;
    require '../../../vendor/autoload.php';

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $dep = $_POST['depa'];

    if($_POST['area'] <> 3){
        $query="UPDATE desviaciones SET consecuencia='$_POST[consecuencia1]', acciones='$_POST[acciones1]', responsable='$_POST[responsable1]', observaciones='$_POST[observaciones1]',fec_edicion='$fecha',id_usuario_edicion='$id_usuario',fec_ejecucion='$_POST[ejecucion1]',log_ejecucion='$_POST[radio]' where id_desviacion=$_POST[id1]";
        if (conectar()->query($query) === TRUE) 
        {
            if($_POST['radio'] == 0){$estado = "En Proceso";}else{$estado ="Terminado";}
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth   = true;
            $mail->Username   = "sismantencionlandes@gmail.com";
            $mail->Password   = "vaongachlooxposk";
            $mail->SetFrom('sismantencionlandes@gmail.com', 'DESVIACIONES');
            $consulta = "CALL consulta_correos_area(3)";
            $resultado = mysqli_query( conectar(), $consulta );
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                $mail->AddAddress($columna['email'], $columna['nombre']);
            }
            $mail->Subject = 'AC '.$_POST['id1'];
            $mail->MsgHTML("<html> 
                                <head> 
                                    <title>Sistema Mantención</title> 
                                </head> 
                                <body> 
                                    <h1>Se respondio desviación N° ".$_POST['id1']."!</h1> 
                                    <p> 
                                        <h2>Estado: ".$estado."</h2> 
                                    </p> 
                                    <p>
                                        Favor no responder este mensaje, Gracias!!.
                                    </p>
                                </body> 
                            </html>");
            $mail->CharSet = 'UTF-8';
            if(!$mail->Send()) {
                $messages[] = "Desviación guardada satisfactoriamente.";
            } else {
                echo $mail->ErrorInfo;
            }  
        }
    
        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }
    else
    {
        $query="UPDATE desviaciones SET observaciones='$_POST[observaciones1]', id_estado=$_POST[estado],fec_edicion='$fecha',id_usuario_verificacion='$id_usuario',fec_verificacion='$fecha' where id_desviacion=$_POST[id1]";
        if (conectar()->query($query) === TRUE) 
        {
            if($_POST['estado'] == 1){$estado = "Ingresado";}else{$estado ="Verificado";}
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth   = true;
            $mail->Username   = "sismantencionlandes@gmail.com";
            $mail->Password   = "vaongachlooxposk";
            $mail->SetFrom('sismantencionlandes@gmail.com', 'DESVIACIONES');
            $consulta = "CALL consulta_correos_area($dep)";
            $resultado = mysqli_query( conectar(), $consulta );
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                $mail->AddAddress($columna['email'], $columna['nombre']);
            }
            $mail->Subject = 'AC '.$_POST['id1'];
            $mail->MsgHTML("<html> 
                                <head> 
                                    <title>Sistema Mantención</title> 
                                </head> 
                                <body> 
                                    <h1>Se verifico desviación N° ".$_POST['id1']."!</h1> 
                                    <p> 
                                        <h2>Estado: ".$estado."</h2> 
                                    </p> 
                                    <p>
                                        Favor no responder este mensaje, Gracias!!.
                                    </p>
                                </body> 
                            </html>");
            $mail->CharSet = 'UTF-8';
            if(!$mail->Send()) {
                $messages[] = "Desviación guardada satisfactoriamente.";
            } else {
                echo $mail->ErrorInfo;
            }  
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