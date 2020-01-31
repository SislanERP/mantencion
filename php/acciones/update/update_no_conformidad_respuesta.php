<?php
    session_start();
    include ('../../conexion.php');
    use PHPMailer\PHPMailer\PHPMailer;
    require '../../../vendor/autoload.php';

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $dep = $_POST['depa'];
    $target_path = "../../../img/no_conformidades/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $consulta = "SELECT * FROM no_conformidades where id_no_conformidad=$_POST[id1]";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $imagen = "img/no_conformidades/".$_FILES['imagen1']['name'];
        if(empty($_FILES['imagen1']['name']))
        {
            if($_POST['estado'] == 1 && $_POST['area'] <> 3)
            {
                $query="UPDATE no_conformidades SET causa_raiz='$_POST[causa1]', correctivo='$_POST[correctivo1]', preventivo = '$_POST[preventivo1]', responsable ='$_POST[responsable1]', fec_ejecucion='$_POST[ejecucion1]', log_ejecucion='$_POST[radio]',fec_edicion='$fecha',id_usuario_edicion='$id_usuario' where id_no_conformidad=$_POST[id1]";
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
                        $mail->SetFrom('sismantencionlandes@gmail.com', 'Sistema Mantención');
                        $consulta = "CALL consulta_correos_area(3)";
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
                                                <h1>Se respondio no conformidad N° ".$_POST['id1']."!</h1> 
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
                            $messages[] = "No Conformidad verificada satisfactoriamente.";
                        } else {
                            echo $mail->ErrorInfo;
                        }  
                }
    
                else
                {
                    $errors []= "".mysqli_error(conectar());
                }
            }
            else
            {
                if($_POST['estado'] == 2)
                {
                    $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado] where id_no_conformidad=$_POST[id1]";
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
                        $consulta = "CALL consulta_correos_area($dep)";
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
                                                <h1>Se respondio no conformidad N° ".$_POST['id1']."!</h1> 
                                                <p> 
                                                    <h2>Estado: ".$_POST['estado']."</h2> 
                                                </p> 
                                                <p>
                                                    Favor no responder este mensaje, Gracias!!.
                                                </p>
                                            </body> 
                                        </html>");
                        $mail->CharSet = 'UTF-8';
                        if(!$mail->Send()) {
                            $messages[] = "No Conformidad verificada satisfactoriamente.";
                        } else {
                            echo $mail->ErrorInfo;
                        }  
                    }
        
                    else
                    {
                        $errors []= "".mysqli_error(conectar());
                    }
                }
                else
                {
                    $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado] where id_no_conformidad=$_POST[id1]";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "No Conformidad respondida satisfactoriamente.";
                    }
        
                    else
                    {
                        $errors []= "".mysqli_error(conectar());
                    }
                }
                
            }
            
        }
        else
        {
            if($_POST['estado'] == 2)
            {
                if($columna['img_despues'] == $imagen)
                {
                    $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado] where id_no_conformidad=$_POST[id1]";
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
                        $consulta = "CALL consulta_correos_area($dep)";
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
                                                <h1>Se respondio no conformidad N° ".$_POST['id1']."!</h1> 
                                                <p> 
                                                    <h2>Estado: ".$_POST['estado']."</h2> 
                                                </p> 
                                                <p>
                                                    Favor no responder este mensaje, Gracias!!.
                                                </p>
                                            </body> 
                                        </html>");
                        $mail->CharSet = 'UTF-8';
                        if(!$mail->Send()) {
                            $messages[] = "No Conformidad verificada satisfactoriamente.";
                        } else {
                            echo $mail->ErrorInfo;
                        }  
                    }
    
                    else
                    {
                        $errors []= "".mysqli_error(conectar());
                    }
                }
                else
                {
                    $target = $target_path . basename( $_FILES['imagen1']['name']);
                    if(move_uploaded_file($_FILES['imagen1']['tmp_name'], $target))
                    {
                        $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado], fec_edicion='$fecha',id_usuario_edicion=$id_usuario, img_despues='img/no_conformidades/".$_FILES['imagen1']['name']."' where id_no_conformidad=$_POST[id1]";
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
                            $consulta = "CALL consulta_correos_area($dep)";
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
                                                    <h1>Se respondio no conformidad N° ".$_POST['id1']."!</h1> 
                                                    <p> 
                                                        <h2>Estado: ".$_POST['estado']."</h2> 
                                                    </p> 
                                                    <p>
                                                        Favor no responder este mensaje, Gracias!!.
                                                    </p>
                                                </body> 
                                            </html>");
                            $mail->CharSet = 'UTF-8';
                            if(!$mail->Send()) {
                                $messages[] = "No Conformidad verificada satisfactoriamente.";
                            } else {
                                echo $mail->ErrorInfo;
                            }  
                        }
    
                        else
                        {
                            $errors []= "".mysqli_error(conectar());
                        }
                    }
                    else
                    {
                        $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado], fec_edicion='$fecha',id_usuario_edicion=$id_usuario, img_despues='img/no_conformidades/".$_FILES['imagen1']['name']."' where id_no_conformidad=$_POST[id1]";
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
                            $consulta = "CALL consulta_correos_area($dep)";
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
                                                    <h1>Se respondio no conformidad N° ".$_POST['id1']."!</h1> 
                                                    <p> 
                                                        <h2>Estado: ".$_POST['estado']."</h2> 
                                                    </p> 
                                                    <p>
                                                        Favor no responder este mensaje, Gracias!!.
                                                    </p>
                                                </body> 
                                            </html>");
                            $mail->CharSet = 'UTF-8';
                            if(!$mail->Send()) {
                                $messages[] = "No Conformidad guardada satisfactoriamente.";
                            } else {
                                echo $mail->ErrorInfo;
                            }  
                        }
    
                        else
                        {
                            $errors []= "".mysqli_error(conectar());
                        }
                    }
                    
                }
            }
            else
            {
                if($columna['img_despues'] == $imagen)
                {
                    $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado] where id_no_conformidad=$_POST[id1]";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "No Conformidad guardada satisfactoriamente.";
                    }

                    else
                    {
                        $errors []= "".mysqli_error(conectar());
                    }
                }
                else
                {
                    $target = $target_path . basename( $_FILES['imagen1']['name']);
                    if(move_uploaded_file($_FILES['imagen1']['tmp_name'], $target))
                    {
                        $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado], fec_edicion='$fecha',id_usuario_edicion=$id_usuario, img_despues='img/no_conformidades/".$_FILES['imagen1']['name']."' where id_no_conformidad=$_POST[id1]";
                        if (conectar()->query($query) === TRUE) 
                        {
                            $messages[] = "No Conformidad guardada satisfactoriamente.";
                        }

                        else
                        {
                            $errors []= "".mysqli_error(conectar());
                        }
                    }
                    else
                    {
                        $query="UPDATE no_conformidades SET observaciones = '$_POST[observaciones1]', id_estado=$_POST[estado], fec_edicion='$fecha',id_usuario_edicion=$id_usuario, img_despues='img/no_conformidades/".$_FILES['imagen1']['name']."' where id_no_conformidad=$_POST[id1]";
                        if (conectar()->query($query) === TRUE) 
                        {
                            $messages[] = "No Conformidad guardada satisfactoriamente.";
                        }

                        else
                        {
                            $errors []= "".mysqli_error(conectar());
                        }
                    }
                    
                }
            }
            
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