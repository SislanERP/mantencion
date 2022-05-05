<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

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

    if($_POST['camiones0'] == ""){$camiones=0;}else{$camiones=$_POST['camiones0'];}
    if($_POST['kilos_mm_pp0'] == ""){$kilos_mm_pp=0;}else{$kilos_mm_pp=$_POST['kilos_mm_pp0'];}
    if($_POST['kilos_producidos0'] == ""){$kilos_producidos=0;}else{$kilos_producidos=$_POST['kilos_producidos0'];}
    if($_POST['rendimiento0'] == ""){$rendimiento=0;}else{$rendimiento=$_POST['rendimiento0'];}
    if($_POST['kilos_embolsado0'] == ""){$kilos_embolsado=0;}else{$kilos_embolsado=$_POST['kilos_embolsado0'];}

    $consulta = "SELECT * FROM detenciones where fecha='".$_POST['fecha0']."'";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $errors []= "Lo siento no puede ingresar dos veces un mismo día.";
    }
    else
    {
        $query="INSERT INTO detenciones (id_detencion,fecha,camiones,kilos_mm_pp,kilos_producidos,rendimiento,kilos_embolsado,fec_registro,id_usuario_registro) values($contador,'$_POST[fecha0]',$camiones,$kilos_mm_pp,$kilos_producidos,$rendimiento,$kilos_embolsado,'$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Detencioón guardada satisfactoriamente.";
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