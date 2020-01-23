<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT * FROM detenciones where fecha ='$_POST[fecha]'";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $query="UPDATE detenciones SET camiones=$_POST[camiones],kilos_mm_pp=$_POST[kilos_mm_pp],kilos_producidos=$_POST[kilos_producidos],rendimiento=$_POST[rendimiento],kilos_embolsado=$_POST[kilos_embolsado],fec_edicion='$fecha', id_usuario_edicion=$id_usuario where fecha='$_POST[fecha]'";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Información de producción actualizada satisfactoriamente.";
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }
    else
    {
        $consulta = "SELECT max(id_detencion) as correlativo FROM detenciones";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        { 
            $contador = $columna['correlativo'] + 1;
        }
        else
        {
            $contador = 1;
        }

        $query="INSERT INTO detenciones (id_detencion,fecha,camiones,kilos_mm_pp,kilos_producidos,rendimiento,kilos_embolsado,fec_registro,id_usuario_registro) values($contador,'$_POST[fecha]',$_POST[camiones],$_POST[kilos_mm_pp],$_POST[kilos_producidos],$_POST[rendimiento],$_POST[kilos_embolsado],'$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Información de producción guardada satisfactoriamente.";
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