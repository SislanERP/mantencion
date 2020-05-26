<?php 
    session_start();
    require_once("../php/conexion.php");

    $año = $_POST['año'];
    $mes_inicial = $_POST['mes_inicial'];
    $mes_final = $_POST['mes_final'];

    $a = array();
    $b = array();
    $c = array();
    $meses = array();

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
                $consulta = "call consulta_grafico_anual($año,$i)";
                $resultado = mysqli_query( conectar(), $consulta );
                if ($columna = mysqli_fetch_array( $resultado ))
                {
                    if(empty($columna['total']))
                    {
                        $a[] = 0;
                        $b[] = 0;
                        $c[] = 0;
                        $meses[] = "";
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
                        $b[] = $q[0];
                        $c[] = $v_HorasPartes[0];

                        switch ($i) {
                            case 1:
                                $meses[] = "Enero";
                            break;
                            case 2:
                                $meses[] = "Febrero";
                            break;
                            case 3:
                                $meses[] = "Marzo";
                            break;
                            case 4:
                                $meses[] = "Abril";
                            break;
                            case 5:
                                $meses[] = "Mayo";
                            break;
                            case 6:
                                $meses[] = "Junio";
                            break;
                            case 7:
                                $meses[] = "Julio";
                            break;
                            case 8:
                                $meses[] = "Agosto";
                            break;
                            case 9:
                                $meses[] = "Septiembre";
                            break;
                            case 10:
                                $meses[] = "Octubre";
                            break;
                            case 11:
                                $meses[] = "Noviembre";
                            break;
                            case 12:
                                $meses[] = "Diciembre";
                            break;
                        }
                    }
                }
            }

            $porcentaje = json_encode($a);
            $produccion = json_encode($b);
            $horas = json_encode($c);
            $data = json_encode($meses);
        
                echo "
                    <script>
                        var densityCanvas = document.getElementById('myChart');
        
                        Chart.defaults.global.defaultFontFamily = 'Lato';
                        Chart.defaults.global.defaultFontSize = 15;
        
                        var densityData = {
                            label: 'HProd',
                            data: $produccion,
                            backgroundColor: 'rgba(0, 99, 132, 0.6)',
                            borderWidth: 0,
                            yAxisID: 'y-axis-density'
                        };
                                
                        var gravityData = {
                            label: '%P',
                            data: $porcentaje,
                            backgroundColor: 'rgba(99, 132, 0, 0.6)',
                            borderWidth: 0,
                            yAxisID: 'y-axis-gravity'
                        };
        
                        var Horas = {
                            label: 'HP',
                            data: $horas,
                            borderWidth: 0,
                            yAxisID: 'y-axis-horas'
                        };
                                
                        var planetData = {
                            labels: $data,
                            datasets: [densityData, gravityData]
                        };
        
                        var chartOptions = {
                            showAllTooltips: true,
                            tooltips : {
                                callbacks : {
                                    afterLabel : function(tooltipItem, data) {
                                        return 'Horas Parados: '+Horas['data'][tooltipItem['index']];
                                    }
                                }
                
                            },
                            scales: {
                                xAxes: [{
                                    barPercentage: 1,
                                    categoryPercentage: 0.4
                                }],
                                yAxes: 
                                [
                                    {
                                        ticks: 
                                        {
                                            suggestedMin: 0,
                                            suggestedMax: 450
                                        },
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Horas Productivas'
                                        },
                                        id: 'y-axis-density',
                                        
                                    },
                                    {
                                        ticks: 
                                        {
                                            suggestedMin: 0,
                                            suggestedMax: 100,
                                            display:false
                                        },
                                        scaleLabel: {
                                            display: false,
                                            labelString: 'Porcentaje'
                                        },
                                        gridLines: {
                                            drawBorder: false,
                                            display: false,
                                          },
                                        id: 'y-axis-gravity'
                                    }
                                ]
                            }
                        };

                        Chart.pluginService.register({
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
                        })
        
                        var barChart = new Chart(densityCanvas, {
                            type: 'bar',
                            data: planetData,
                            options: chartOptions,
                            
                        });
                        
                    </script>
                  ";
            
        }
    }
    
    
    
?>