<?php 
    session_start();
    require_once("../php/conexion.php");
    $valores = "";

    if(empty($_POST['año']))
    {
?>
        <div class="alert alert-warning alert-dismissable mt-3">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>Aviso!!!</h4> No hay datos para mostrar
        </div>
<?php }
    
    else
    {
            $consulta = "call consulta_dia_menor($_POST[mes], $_POST[año])";
            $resultado = mysqli_query( conectar(), $consulta );
            if ($columna = mysqli_fetch_array( $resultado ))
            {
            $menor = $columna['menor'];
            $consulta = "call consulta_dia_mayor($_POST[mes], $_POST[año])";
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
        
            $consulta = "call consulta_paras_por_ubicacion('$menor','$mayor')";
            $resultado = mysqli_query( conectar(), $consulta );

            while ($columna = mysqli_fetch_array( $resultado ))
            {
                $time = strtotime($columna['suma']);
                $valores = $valores."{linea:'".$columna['ubicacion']."', tiempo: '".date("H:i",$time)."', menor: '".$menor."', mayor: '".$mayor."', id:'".$columna['id']."', equipo:'".$columna['equipo']."'},";
            }

            $newstring = rtrim($valores, ",");
                    
        ?>
            <script>
                am4core.useTheme(am4themes_animated);
                    
                    var chart = am4core.create('chartdiv', am4charts.PieChart3D);
                    chart.hiddenState.properties.opacity = 0; 
                    
                    chart.legend = new am4charts.Legend();
                    
                    chart.data = [
                        <?=$newstring?>
                    ];
                    
                    chart.innerRadius = 100;
                    
                    var series = chart.series.push(new am4charts.PieSeries3D());
                    series.dataFields.value = 'tiempo';
                    series.dataFields.category = 'linea';
                    series.dataFields.enlace = 'href';

                    series.tooltip.label.interactionsEnabled = true;
                    series.tooltip.keepTargetHover = true;
                    series.slices.template.tooltipHTML = "{category}: {tiempo} (<a style='color:#fff;' href='#' data-toggle='modal' data-target='#Detalle' data-menor='{menor}' data-mayor='{mayor}' data-id='{id}' data-equipo?'{equipo}' data-tiempo='{tiempo}'>Más información</a>)";
            </script>
        <?php 
        } 
        
        else
        { ?>
            <div class="alert alert-warning alert-dismissable mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
<?php }} ?>
        