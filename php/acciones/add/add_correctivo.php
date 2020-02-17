<?php
    session_start();
    include ('../../conexion.php');

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

    if(empty($_POST['ot_padre0'])){$ote="NULL";}else{$ote=$_POST['ot_padre0'];}
    
    $query="INSERT INTO correctivos (id_correctivo,ot_padre,fec_inicio,id_prioridad,id_tipo_mantenimiento,id_equipo,actividad,id_responsable,id_estado,fec_registro,id_usuario_registro) values($contador,$ote,'$_POST[fecha0]',$_POST[prioridad0],1,$_POST[equipo0],'$_POST[actividad0]',$_POST[responsable0],1,'$fecha',$id_usuario)";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Correctivo guardado satisfactoriamente.";
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