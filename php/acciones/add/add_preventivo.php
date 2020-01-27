<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $fecha_inicial = $_POST['fecha0'];
    $año_siguiente = strtotime($fecha_inicial."+ 1 year");
    $fecha_modificada = date("Y-m-d");
    $mes_actual = date("m",strtotime($fecha_inicial));

    while($fecha_modificada < $año_siguiente)
    {
        if($_POST['frecuencia0'] == 1)
        { 
            $frecuencia = "days";
        }

        if($_POST['frecuencia0'] == 2)
        { 
            $frecuencia = "week";
        }

        if($_POST['frecuencia0'] == 3)
        { 
            $frecuencia = "month";
        }

        if($_POST['frecuencia0'] == 4)
        { 
            $frecuencia = "year";
        }

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

        $consulta = "SELECT * FROM preventivos WHERE id_equipo = $_POST[equipo0] and YEAR(fec_inicio) = YEAR(now())";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        { 
            $query="INSERT INTO preventivos (id_preventivo,fec_inicio,id_tipo_mantenimiento,id_equipo,id_frecuencia,id_estado,fec_registro,id_usuario_registro) values($contador,'$fec_inicio',2,$_POST[equipo0],$_POST[frecuencia0],1,'$fecha',$id_usuario)";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Preventivo guardado satisfactoriamente.";
            }

            else
            {
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
            }
        }
        else
        {
            $query="INSERT INTO preventivos (id_preventivo,fec_inicio,id_tipo_mantenimiento,id_equipo,id_frecuencia,id_estado,fec_registro,id_usuario_registro) values($contador,'$fecha_inicial',2,$_POST[equipo0],$_POST[frecuencia0],1,'$fecha',$id_usuario)";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Preventivo guardado satisfactoriamente.";
            }

            else
            {
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
            }
        }

        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fecha_inicial));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
        $mes_actual = $mes_actual + 1;
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