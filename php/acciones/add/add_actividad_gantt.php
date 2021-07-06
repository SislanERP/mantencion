<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT max(id_registro) as correlativo FROM gantt_detalle_actividad";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    $query="INSERT INTO gantt_detalle_actividad (id_registro,id_gantt_detalle_equipo,actividad,fec_inicio,fec_termino,id_usuario_responsable,fec_registro,id_usuario_registro) values($contador,$_POST[id_gantt_equipo],'$_POST[actividad]','$_POST[fec_inicio]','$_POST[fec_termino]',$_POST[responsable],'$fecha',$id_usuario)";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Actividad guardada satisfactoriamente.";
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