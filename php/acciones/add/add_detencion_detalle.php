<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $fec_detencion = $_SESSION['fecha_detencion']; 

    $consulta = "SELECT * FROM detenciones where fecha = '$fec_detencion'";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $detencion = $columna['id_detencion'];
    }

    $consulta = "SELECT max(id_registro) as correlativo FROM detalle_detencion";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }
    
    $query="INSERT INTO detalle_detencion (id_registro,id_detencion,id_tipo_falla,id_equipo,descripcion,hora_falla,tiempo,detencion_proceso,fec_registro,id_usuario_registro) values($contador,$detencion,$_POST[tipo0],$_POST[equipo0],'$_POST[descripcion0]','$_POST[falla0]','$_POST[tiempo0]',$_POST[detencion_proceso0],'$fecha',$id_usuario)";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Detención guardada satisfactoriamente.";
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