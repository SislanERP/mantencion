<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $fec_trabajada = "";
    $nombre ="";
    
    $query="UPDATE libres SET fec_pagada='$_POST[fecha]',fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_libre=$_POST[id]";
    if (conectar()->query($query) === TRUE) 
    {
        $consulta = "call consulta_correo_libre($_POST[id])";
		$resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		if ($columna = mysqli_fetch_array( $resultado ))
		{
            $fec_trabajada = $columna['fec_trabajada'];
            $nombre = $columna['nombre'];
        }

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host       = 'smtp.gmail.com';
        $mail->Port       = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth   = true;
        $mail->Username   = "sismantencionlandes@gmail.com";
        $mail->Password   = getenv("pass_correo");
        $mail->SetFrom('sismantencionlandes@gmail.com', 'Sistema Mantención');
        $mail->addCC('cristianasenjotorres@gmail.com');
        $mail->AddAddress("casenjo@landes.cl","Cristian Asenjo");
        $mail->Subject = 'Día libre';
        $mail->MsgHTML("<html> 
                            <head> 
                                <title>Sistema Mantención</title> 
                            </head> 
                            <body> 
                                <p>Estimada Adriana,</p>
                                <p> 
                                    Junto con saludar informo que ".$nombre." hara uso de un dia libre el ".$_POST['fecha']." por trabajar el ".$fec_trabajada.".
                                </p> 
                                <p>
                                    desde ya se agradece la gestión, saludos cordiales.
                                </p>
                                <p>
                                    Favor no responder este mensaje, Gracias!!.
                                </p>
                            </body> 
                        </html>");
        $mail->CharSet = 'UTF-8';
        if(!$mail->Send()) {
            $messages[] = "El día libre ha sido asignado satisfactoriamente.";
        } else {
            echo $mail->ErrorInfo;
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