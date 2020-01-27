<?php 

    $fecha_inicial = date("Y-m-d");
    $año_siguiente = strtotime($fecha_inicial."+ 1 year");
    $fecha_modificada = date("Y-m-d");
    $mes_actual = date("m",strtotime($fecha_inicial));

    while($fecha_modificada < $año_siguiente)
    {
        $fecha_modificada = strtotime ('+'.$mes_actual.' month', strtotime($fecha_inicial));

        echo date("Y-m-d",$fecha_modificada)." - ";
        $mes_actual = $mes_actual + 1;
    }

    // while($mes_actual < 12)
    // {
    //     $fecha_modificada = strtotime ('+'.$meses.' month', strtotime($fecha_inicial));

    //     echo date("Y-m-d",$fecha_modificada)." - ";
    //     $mes_actual = $mes_actual + 1;
    //     $meses = $meses + 1;
    // }

    
?>