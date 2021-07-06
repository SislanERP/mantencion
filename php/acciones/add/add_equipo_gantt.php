<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT max(id_registro) as correlativo FROM gantt_detalle_equipo";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }


    $consulta = "SELECT * FROM gantt_detalle_equipo where id_gantt=$_POST[id_gantt] and id_equipo=$_POST[list_equi]";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $errors []= "Lo siento no puede ingresar dos veces el mismo equipo.";
    }
    else
    {
        $query="INSERT INTO gantt_detalle_equipo (id_registro,id_gantt,id_equipo,fec_registro,id_usuario_registro) values($contador,$_POST[id_gantt],$_POST[list_equi],'$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Equipo guardado satisfactoriamente.";
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