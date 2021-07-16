<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT a.id_registro as id FROM gantt_detalle_equipo a inner join gantt_detalle_actividad b on a.id_registro = b.id_gantt_detalle_equipo where a.id_equipo =$_POST[e_copiar] group by a.id_registro";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $iii = $columna['id'];
        $consulta1="SELECT * FROM gantt_detalle_equipo WHERE id_equipo =  $_POST[e_pegar]";
        $resultado1 = mysqli_query( conectar(), $consulta1 );
	    if ($columna1 = mysqli_fetch_array( $resultado1 ))
	    {
            $ii = $columna1['id_registro'];
            $consulta = "SELECT * FROM gantt_detalle_actividad where id_gantt_detalle_equipo =$iii";
            $resultado = mysqli_query( conectar(), $consulta );
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                $consulta2 = "SELECT max(id_registro) as correlativo FROM gantt_detalle_actividad";
                $resultado2 = mysqli_query( conectar(), $consulta2 );
                if ($columna2 = mysqli_fetch_array( $resultado2 ))
                { 
                    $id = $columna2['correlativo'] + 1;
                }
                else
                {
                    $id = 1;
                }
                
                $query="INSERT INTO gantt_detalle_actividad (id_registro,id_gantt_detalle_equipo,actividad,fec_inicio,fec_termino,fec_registro,id_usuario_responsable,id_usuario_registro) values($id,$ii,'$columna[actividad]','$columna[fec_inicio]','$columna[fec_termino]','$fecha',$columna[id_usuario_responsable],$id_usuario)";
                if (conectar()->query($query) === TRUE) {$messages[] = "Equipo copiado satisfactoriamente.";}
            }  
            
        }
        else
        {
            $errors []= "No puede copiar si el equipo no esta en la lista.";
        }
    }
    else
    {
        $errors []= "Equipo no cuenta con actividades registradas.";
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