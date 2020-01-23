<?php
    session_start();
    include ('../../conexion.php');

    $consulta = "SELECT max(id_vehiculo) as correlativo FROM vehiculos";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }
    
    if(empty($_POST['año0'])){$año="NULL";}else{$año=$_POST['año0'];}
    if(empty($_POST['rut0'])){$rut="";}else{$rut=$_POST['rut0'];}
    if(empty($_POST['telefono0'])){$telefono="";}else{$telefono=$_POST['telefono0'];}
    if(empty($_POST['email0'])){$email="";}else{$email=$_POST['email0'];}

    $query="INSERT INTO vehiculos (id_vehiculo,patente,marca,modelo,año,rut,nombre,telefono,email) values($contador,'$_POST[patente0]','$_POST[marca0]','$_POST[modelo0]',$año,'$rut','$_POST[nombre0]','$telefono','$email')";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Los datos del vehiculo han sido guardados satisfactoriamente.";
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