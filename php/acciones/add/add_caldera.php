<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
    
    $consulta = "SELECT * FROM caldera where fecha ='$_POST[fecha]'";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $query="UPDATE caldera SET hora_encendido='$_POST[hora_encendido]', hora_apagado='$_POST[hora_apagado]',observacion='$_POST[observacion]',fec_edicion='$fecha', id_usuario_edicion=$id_usuario where fecha='$_POST[fecha]'";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Información del control actualizada satisfactoriamente.";
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }
    else
    {
        $consulta = "SELECT max(id_control) as correlativo FROM caldera";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        { 
            $contador = $columna['correlativo'] + 1;
        }
        else
        {
            $contador = 1;
        }

        $query="INSERT INTO caldera (id_control,fecha,hora_encendido,hora_apagado,observacion,fec_registro,id_usuario_registro) values($contador,'$_POST[fecha]','$_POST[hora_encendido]','$_POST[hora_apagado]','$_POST[observacion]','$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Información del control guardada satisfactoriamente.";
        }

        else
        {
            $errors []= "Debe completar todos los campos.".mysqli_error(conectar());
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