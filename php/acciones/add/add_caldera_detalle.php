<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $fec_control = $_SESSION['fecha_caldera']; 

    $consulta = "SELECT * FROM caldera where fecha = '$fec_control'";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $control = $columna['id_control'];
    }

    $consulta = "SELECT max(id_registro) as correlativo FROM detalle_caldera";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    $total = $_POST['salida0'] - $_POST['entrada0'];
    
    $query="INSERT INTO detalle_caldera (id_registro,id_control,id_turno,id_tipo,entrada,salida,total,fec_registro,id_usuario_registro) values($contador,$control,$_POST[turno0],$_POST[tipo0],$_POST[entrada0],$_POST[salida0],$total,'$fecha',$id_usuario)";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Consumo guardado satisfactoriamente.";
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