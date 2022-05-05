<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
    
    $query="UPDATE libres SET fec_pagada='$_POST[fecha_pagada]',fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_libre=$_POST[id]";
    if (conectar()->query($query) === TRUE) 
    {
        $consulta = "call enviar_libres($_POST[id])";
	    $resultado = mysqli_query( conectar(), $consulta );
	    if ($columna = mysqli_fetch_array( $resultado ))
	    {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 1;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth   = true;
            $mail->Username   = "sismantencionlandes@gmail.com";
            $mail->Password   = getenv("pass_correo");
            $mail->SetFrom('sismantencionlandes@gmail.com', 'Sistema Mantención');
            $mail->AddAddress("casenjo@landes.cl", "Cristian Asenjo");
            $mail->Subject = 'Día libre '.$columna['usuario'];
            $mail->MsgHTML("<html> 
                                <head> 
                                    <title>Sistema Mantención</title> 
                                </head> 
                                <body> 
                                    <p> 
                                        Estimada Adriana,
                                    </p> 
                                    <p>
                                        Junto con saludar, informo que ".$columna['usuario']." hará  uso de un día libre el ".$columna['fecha_pagada'].", por trabajar el ".$columna['fecha_trabajada'].".
                                    </p>
                                    <p>
                                        Desde ya se agradece la gestión, saludos cordiales.
                                    </p>
                                    </br>
                                    <p>
                                        <i>Mensaje enviado automáticamente por el sistema de mantención</i>
                                    </p>
                                </body> 
                            </html>");
            $mail->CharSet = 'UTF-8';
            if(!$mail->Send()) {
                $messages[] = "El día libre ha sido editado satisfactoriamente.";
            } else {
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
            }  
        }
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