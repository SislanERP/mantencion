<?php 
    session_start();
    require_once("../php/conexion.php");

    $año = $_POST['año'];
    $mes_inicial = $_POST['mes_inicial'];
    $mes_final = $_POST['mes_final'];

    $a = array();
    $u = array();
    $c = array();

    if(empty($año) or empty($mes_inicial) or empty($mes_final))
    {
        echo 1; //debe llenar todos los campos
    }
    else
    {
        if($mes_final < $mes_inicial)
        {
            echo 2; // mes final debe ser mayor que mes inicial
        }

        else
        {
            for($i=$mes_inicial; $i<=$mes_final; $i++)
            {
                $consulta = "call consulta_grafico_equipos($i,$año)";
                $resultado = mysqli_query( conectar(), $consulta );
                while ($columna = mysqli_fetch_array( $resultado ))
                {
                    if(empty($columna['total']))
                    {
                        $a[] = 0;
                        $u[] = "";
                        $c = "";
                    }
                    else
                    {
                        $horaEntrada = $columna['total'];	
                        $v_HorasPartes = explode(":", $horaEntrada);
                        $minutosTotales= ($v_HorasPartes[0] * 60) + $v_HorasPartes[1];
        
                        $hora_produccion = $columna['horas_productivas'];
                        $q = explode(":", $hora_produccion);
                        $v_HorasPartes1 = explode(":", $hora_produccion);
                        $minutosTotales1= ($v_HorasPartes1[0] * 60) + $v_HorasPartes1[1];
        
                        $por_paras = $minutosTotales * 100 / $minutosTotales1;
                        $a[] = round($por_paras,2);
                        $u[] = $columna['ubicacion'];
                        $c[] = "#66a1b5";
                    }
                }
                
            }

            $porcentaje = json_encode($a);
            $ubicacion = json_encode($u);
            $color = json_encode($c);
        
                echo "
                    <script>
                    var MeSeContext = document.getElementById('myChart1').getContext('2d');
                    var MeSeData = {
                        labels: $ubicacion,
                        datasets: [{
                            label: 'Porcentaje',
                            data: $porcentaje,
                            backgroundColor: $color
                        }]
                    };
                    
                    var MeSeChart = new Chart(MeSeContext, {
                        type: 'horizontalBar',
                        data: MeSeData,
                        options: {
                            showAllTooltips: true,
                            legend: {
                            display: false
                            },
                            scales: {
                                xAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                yAxes: [{
                                    stacked: true
                                }]
                            }
                    
                        },
                        plugins: [{
                            beforeRender: function (chart) {
                                if (chart.config.options.showAllTooltips) {
                                    // create an array of tooltips
                                    // we can't use the chart tooltip because there is only one tooltip per chart
                                    chart.pluginTooltips = [];
                                    chart.config.data.datasets.forEach(function (dataset, i) {
                                        chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                                            chart.pluginTooltips.push(new Chart.Tooltip({
                                                _chart: chart.chart,
                                                _chartInstance: chart,
                                                _data: chart.data,
                                                _options: chart.options.tooltips,
                                                _active: [sector]
                                            }, chart));
                                        });
                                    });
                        
                                    // turn off normal tooltips
                                    chart.options.tooltips.enabled = false;
                                }
                            },
                            afterDraw: function (chart, easing) {
                                if (chart.config.options.showAllTooltips) {
                                    // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                                    if (!chart.allTooltipsOnce) {
                                        if (easing !== 1)
                                            return;
                                        chart.allTooltipsOnce = true;
                                    }
                        
                                    // turn on tooltips
                                    chart.options.tooltips.enabled = true;
                                    Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                                        tooltip.initialize();
                                        tooltip.update();
                                        // we don't actually need this since we are not animating tooltips
                                        tooltip.pivot();
                                        tooltip.transition(easing).draw();
                                    });
                                    chart.options.tooltips.enabled = false;
                                }
                            }
                        }]
                    });

                    
                    </script>
                  ";
            
        }
    }
    
    
    
?>