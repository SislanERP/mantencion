<?php
    session_start();
    include ('../../conexion.php');
    use PHPMailer\PHPMailer\PHPMailer;
    require '../../../vendor/autoload.php';

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    $consulta = "select a.id_usuario_registro as usuario, b.nombre as responsable from requerimientos a inner join trabajadores b on a.id_trabajador=b.id_trabajador where id_requerimiento=".$_POST['id1'];
	$resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ $user = $columna['usuario']; $respon = $columna['responsable'];}

    if($_POST['radio'] <> 1){
        $query="UPDATE requerimientos SET id_prioridad=$_POST[prioridad1], id_trabajador=$_POST[responsable1], desarrollo='$_POST[desarrollo1]', id_estado=3,log_terminado=$_POST[radio],fec_edicion='$fecha',id_usuario_edicion='$id_usuario' where id_requerimiento=$_POST[id1]";
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
            $consulta = "CALL consulta_correo_usuario($user)";
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
                                    <h1>Se finalizo requerimiento</h1> 
                                    <p> 
                                        <h2>N°: ".$_POST['id1']."</h2> 
                                    </p> 
                                    <p> 
                                        <b>Desarrollo:</b></br>
                                        <span>".$_POST['desarrollo1']."</span>
                                    </p>
                                    <p> 
                                        <b>Responsable:</b></br>
                                        <span>".$respon."</span>
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
        $query="UPDATE requerimientos SET log_terminado=$_POST[radio],fec_edicion='$fecha',id_usuario_edicion='$id_usuario' where id_requerimiento=$_POST[id1]";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Requerimiento respondido satisfactoriamente.";
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