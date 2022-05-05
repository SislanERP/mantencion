<?php
	require_once("../php/conexion.php");
	session_start();
    $contador = 0;

    $mes = 2;
    $año = 2020;

    $consulta = "call consulta_dia_menor($mes, $año)";
    $resultado = mysqli_query( conectar(), $consulta );
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        $menor = $columna['menor'];
        $consulta = "call consulta_dia_mayor($mes, $año)";
        $resultado = mysqli_query( conectar(), $consulta );

        if ($columna = mysqli_fetch_array( $resultado ))
        {
            $mayor = $columna['mayor'];
        }
        
        $consulta1 = "call consulta_total_horas_paras('$menor','$mayor')";
        $resultado1 = mysqli_query( conectar(), $consulta1 );
        if ($columna1 = mysqli_fetch_array( $resultado1 ))
        {
            $total = $columna1['total'];
        }
        
        $consulta = "call consulta_paras_por_equipos('$menor','$mayor')";
        $resultado = mysqli_query( conectar(), $consulta );

        while($columna = mysqli_fetch_array($resultado)){
            $arr[$contador] = "<a href='#' id='test' data-toggle='modal' data-target='#Detalle' data-menor='".$menor."' data-mayor='".$mayor."' data-id='".$columna['id']."' data-equipo='".$columna['equipo']."' data-tiempo='".$time."'>".$columna['equipo']."</a>";
            $contador++;
        } 
    }

    echo json_encode($arr);
?>