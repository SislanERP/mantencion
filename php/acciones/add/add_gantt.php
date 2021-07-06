<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT max(id_gantt) as correlativo FROM gantt";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    $consulta = "SELECT * FROM gantt where año=".$_POST['año0'];
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $errors []= "Lo siento no puede ingresar dos veces un mismo año.";
    }
    else
    {
        $query="INSERT INTO gantt (id_gantt,fec_inicio,fec_termino,año,fec_registro,id_usuario_registro) values($contador,'$_POST[inicio0]','$_POST[termino0]',$_POST[año0],'$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Cronograma guardado satisfactoriamente.";
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