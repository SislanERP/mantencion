<?php
    session_start();
    include ('../../conexion.php');
    require '../../../vendor/autoload.php';

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT max(id_correctivo) as correlativo FROM correctivos";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    if(empty($_POST['ot_padre0'])){$ote="NULL"; $ot = "";}else{$ote=$_POST['ot_padre0']; $ot = $_POST['ot_padre0'];}
    
    $query="INSERT INTO correctivos (id_correctivo,ot_padre,fec_inicio,id_prioridad,id_tipo_mantenimiento,id_equipo,actividad,id_responsable,id_estado,fec_registro,id_usuario_registro) values($contador,$ote,'$_POST[fecha0]',$_POST[prioridad0],1,$_POST[equipo0],'$_POST[actividad0]',$_POST[responsable0],1,'$fecha',$id_usuario)";
    if (conectar()->query($query) === TRUE) 
    {
        $consulta = "SELECT * FROM equipos where id_equipo=$_POST[equipo0] and log_pcc = 1";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        { 
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth   = true;
            $mail->Username   = "sismantencionlandes@gmail.com";
            $mail->Password   = getenv("pass_correo");
            $mail->SetFrom('sismantencionlandes@gmail.com', 'CORRECTIVO PROGRAMADO');

            $consulta = "SELECT * FROM int_correo_mantecion_correctiva";
            $resultado = mysqli_query( conectar(), $consulta );
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                $mail->AddAddress($columna['correo'], $columna['nombre']);
            }

            $consulta = "CALL consulta_correctivo($contador)";
            $resultado = mysqli_query( conectar(), $consulta );
            if ($columna = mysqli_fetch_array( $resultado ))
            { 
                $mail->Subject = 'CORRECTIVO PROGRAMADO N° '.$contador;
                $mail->MsgHTML("<html> 
                                    <head> 
                                        <title>Sistema Mantención</title> 
                                    </head> 
                                    <body> 
                                        <h1>Se registro una mantención correctiva!</h1> 
                                        <p> 
                                            <h2>Correctivo Programado N°: ".$contador."</h2> 
                                        </p> 
                                        <p> 
                                            <b>Fecha de intervención:</b></br>
                                            <span>".$columna['fecha']."</span>
                                        </p> 
                                        <p> 
                                            <b>Orden de trabajo padre:</b></br>
                                            <span>".$columna['ot_padre']."</span>
                                        </p> 
                                        <p> 
                                            <b>Prioridad:</b></br>
                                            <span>".$columna['prioridad']."</span>
                                        </p> 
                                        <p> 
                                            <b>Equipo a intervenir:</b></br>
                                            <span>".$columna['equipo']."</span>
                                        </p> 
                                        <p> 
                                            <b>Responsable de la intervención:</b></br>
                                            <span>".$columna['responsable']."</span>
                                        </p> 
                                        <p> 
                                            <b>Detalle de intervención:</b></br>
                                            <span>".$columna['actividad']."</span>
                                        </p> 
                                    </body> 
                                </html>");
                $mail->CharSet = 'UTF-8';
                if($mail->Send()) {
                    $messages[] = "Correctivo guardado satisfactoriamente.";
                } else {
                    echo $mail->ErrorInfo;
                }  
            }
        }
        else{
            $messages[] = "Correctivo guardado satisfactoriamente.";
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