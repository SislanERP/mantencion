<?php
    session_start();
    include ('../../conexion.php');
    use PHPMailer\PHPMailer\PHPMailer;
    require '../../../vendor/autoload.php';
    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $target_path = "../../../img/requerimientos/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $target = $target_path . basename( $_FILES['imagen']['name']);

    $consulta = "SELECT max(id_requerimiento) as correlativo FROM requerimientos";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }
    
    
    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
    {
        $query="INSERT INTO requerimientos (id_requerimiento,actividad,id_estado,imagen,fec_registro,id_usuario_registro) values($contador,'$_POST[actividad0]',1,'img/requerimientos/".$_FILES['imagen']['name']."','$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth   = true;
            $mail->Username   = "sismantencionlandes@gmail.com";
            $mail->Password   = "vaongachlooxposk";
            $mail->SetFrom('sismantencionlandes@gmail.com', 'Sistema Mantención');
            $consulta = "CALL consulta_correos_area(2)";
            $resultado = mysqli_query( conectar(), $consulta );
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                $mail->AddAddress($columna['email'], $columna['nombre']);
            }
            $mail->Subject = 'Sistema Mantención';
            $mail->MsgHTML("<html> 
                                <head> 
                                    <title>Sistema Mantención</title> 
                                </head> 
                                <body> 
                                    <h1>Se registro un requerimiento a su departamento!</h1> 
                                    <p> 
                                        <h2>N°: ".$contador."</h2> 
                                    </p> 
                                    <p> 
                                        <b>Descripción de la actividad:</b></br>
                                        <span>".$_POST['actividad0']."</span>
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
        $query="INSERT INTO requerimientos (id_requerimiento,actividad,id_estado,fec_registro,id_usuario_registro) values($contador,'$_POST[actividad0]',1,'$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth   = true;
            $mail->Username   = "sismantencionlandes@gmail.com";
            $mail->Password   = "vaongachlooxposk";
            $mail->SetFrom('sismantencionlandes@gmail.com', 'REQUERIMIENTOS');
            $consulta = "CALL consulta_correos_area(2)";
            $resultado = mysqli_query( conectar(), $consulta );
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                $mail->AddAddress($columna['email'], $columna['nombre']);
            }
            $mail->Subject = 'RE '.$contador;
            $mail->MsgHTML("<html> 
                                <head> 
                                    <title>Sistema Mantención</title> 
                                </head> 
                                <body> 
                                    <h1>Se registro un requerimiento a su departamento!</h1> 
                                    <p> 
                                        <h2>N°: ".$contador."</h2> 
                                    </p> 
                                    <p> 
                                        <b>Descripción de la actividad:</b></br>
                                        <span>".$_POST['actividad0']."</span>
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