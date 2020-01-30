<?php

session_start();
include ('../../conexion.php');

$año_siguiente = strtotime($_POST['start']."+ 1 year");
$fecha_modificada = date("Y-m-d");
$mes_actual = date("m",strtotime($_POST['start']));

while($fecha_modificada < $año_siguiente)
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

    $consulta = "SELECT * FROM events WHERE title = $_POST[title] and YEAR(start) = YEAR(now())";
    $resultado = mysqli_query( conectar(), $consulta );
    if ($columna = mysqli_fetch_array( $resultado ))
    { 
        $query="INSERT INTO events (id,title,start,end,color) values($contador,'$_POST[title]','$fec_inicio','$_POST[end]','#FF0000')";
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
        $query="INSERT INTO events (id,title,start,end,color) values($contador,'$_POST[title]','$_POST[start]','$_POST[end]','#FF0000')";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "Preventivo guardado satisfactoriamente.";
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }

    $fecha_modificada = strtotime ('+'.$mes_actual.''.$frecuencia, strtotime($_POST['start']));
    $fec_inicio =  date("Y-m-d",$fecha_modificada);
    $mes_actual = $mes_actual + 1;
}

	
?>
