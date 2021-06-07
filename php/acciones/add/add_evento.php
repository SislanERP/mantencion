<?php

session_start();
include ('../../conexion.php');

$año_siguiente = strtotime($_POST['start']."+ 1 year");
$fecha_modificada = strtotime($_POST['start']);
$fec_inicio = $_POST['start'];
$mes_actual = date("m",strtotime($_POST['start']));

while($fecha_modificada <= $año_siguiente)
{
    if($_POST['frecuencia'] == 1)
    { 
        $frecuencia = "days";
    }

    if($_POST['frecuencia'] == 2)
    { 
        $frecuencia = "week";   
    }

    if($_POST['frecuencia'] == 3)
    { 
        $frecuencia = "month";
    }

    if($_POST['frecuencia'] == 4)
    { 
        $frecuencia = "year";
    }

    if($_POST['frecuencia'] == 5)
    { 
        $frecuencia = "month";
    }

    if($_POST['frecuencia'] == 6)
    { 
        $frecuencia = "month";
    }

    if($_POST['frecuencia'] == 7)
    { 
        $frecuencia = "month";
    }

    $consulta = "SELECT max(id) as correlativo FROM events";
    $resultado = mysqli_query( conectar(), $consulta );
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    $query="INSERT INTO events (id,title,start,end,color) values($contador,'$_POST[title]','$fec_inicio','$fec_inicio','#FF0000')";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "Preventivo guardado satisfactoriamente.";
    }

    else
    {
        $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
    }
    
    if($_POST['frecuencia'] == 5)
    { 
        $mes_actual = 2;
        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fec_inicio));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
    }

    if($_POST['frecuencia'] == 6)
    { 
        $mes_actual = 3;
        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fec_inicio));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
    }

    if($_POST['frecuencia'] == 7)
    { 
        $mes_actual = 6;
        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fec_inicio));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
    }

    if($_POST['frecuencia'] == 4)
    { 
        $mes_actual = 1;
        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fec_inicio));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
    }

    if($_POST['frecuencia'] == 3)
    { 
        $mes_actual = 1;
        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fec_inicio));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
    }

    if($_POST['frecuencia'] == 2)
    { 
        $mes_actual = 1;
        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fec_inicio));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
    }

    if($_POST['frecuencia'] == 1)
    { 
        $mes_actual = 1;
        $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($fec_inicio));
        $fec_inicio =  date("Y-m-d",$fecha_modificada);
        
    }

}

	
?>
