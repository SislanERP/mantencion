<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $target_path = "../../../img/equipos/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $target = $target_path . basename( $_FILES['imagen']['name']);

    $consulta = "SELECT max(id_equipo) as correlativo FROM equipos";
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
        $query="INSERT INTO equipos (id_equipo,equipo,marca,id_ubicacion,id_linea,imagen,caracteristicas,fec_registro,id_usuario_registro) values($contador,'$_POST[nombre0]','$_POST[marca0]',$_POST[ubicacion0],$_POST[linea0],'img/equipos/".$_FILES['imagen']['name']."','$_POST[caracteristicas0]','$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "El equipo se guardo satisfactoriamente.";
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }

    else
    {
        $query="INSERT INTO equipos (id_equipo,equipo,marca,id_ubicacion,id_linea,caracteristicas,fec_registro,id_usuario_registro) values($contador,'$_POST[nombre0]','$_POST[marca0]',$_POST[ubicacion0],$_POST[linea0],'$_POST[caracteristicas0]','$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "El equipo se guardo satisfactoriamente.";
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