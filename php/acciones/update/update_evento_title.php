<?php

session_start();
include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $start = $_POST['start1'];
    $id = $_POST['title1'];

    $consulta = "SELECT max(id_preventivo) as correlativo FROM preventivos";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    $consulta = "SELECT * FROM equipos where equipo = '$id'";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $id_equipo = $columna['id_equipo'];
    }

    $query="INSERT INTO preventivos (id_preventivo,fec_inicio,id_tipo_mantenimiento,id_equipo,id_prioridad,id_trabajador,id_estado,fec_registro,id_usuario_registro) VALUES($contador,'$start',2,$id_equipo,$_POST[prioridad],$_POST[responsable],1,'$fecha',$id_usuario)";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Preventivo creado satisfactoriamente.";
    }

    else
    {
        $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
    }
    
    
    $query="UPDATE events SET color = '#008f39' WHERE id = $_POST[id1]";
    if (conectar()->query($query) === TRUE) 
    {
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
