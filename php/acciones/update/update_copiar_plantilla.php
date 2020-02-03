<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT * FROM plantilla_preventiva where id_equipo =$_POST[equipo1]";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $diseño = $columna['detalle'];

        $consulta = "SELECT * FROM plantilla_preventiva where id_equipo =$_POST[equipo2]";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        { 
            $query="UPDATE plantilla_preventiva SET detalle='$diseño',fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_equipo=$_POST[equipo2]";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Plantilla copiada satisfactoriamente.";
            }

            else
            {
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
            }
        }
        else
        {
            $consulta = "SELECT max(id_plantilla) as correlativo FROM plantilla_preventiva";
            $resultado = mysqli_query( conectar(), $consulta );
            if ($columna = mysqli_fetch_array( $resultado ))
            { 
                $contador = $columna['correlativo'] + 1;
            }
            else
            {
                $contador = 1;
            }

            $query="INSERT INTO plantilla_preventiva (id_plantilla,id_equipo,detalle,fec_registro,id_usuario_registro) values($contador,$_POST[equipo2],'$diseño','$fecha',$id_usuario)";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Plantilla copiada satisfactoriamente.";
            }

            else
            {
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
            }
        }
    }
    else
    {
        $errors []= "Equipo que selecciono no tiene plantilla guardada.";
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