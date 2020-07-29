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
            
            $consulta = "call consulta_grafico_equipos($año, $mes_inicial,$mes_final)";
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
                            tooltips: {
                                enabled: false
                            },
                            hover: {
                                animationDuration: 0
                            },
                            animation: {
                                duration: 1,
                                onComplete: function () {
                                    var chartInstance = this.chart,
                                    ctx = chartInstance.ctx;
            
                                    this.data.datasets.forEach(function (dataset, i) {
                                        var meta = chartInstance.controller.getDatasetMeta(i);
                                        meta.data.forEach(function (bar, index) {
                                            var data = dataset.data[index] + ' %';
                                            ctx.fillStyle = '#000';
                                            ctx.fillText(data, bar._model.x + 5, bar._model.y);
                                        });
                                    });
                                }
                            },
                            scales: {
                                xAxes: [{
                                        gridLines: {
                                            display: false
                                        },
                                        ticks: {
                                            beginAtZero: false,
                                            suggestedMin: 0,
                                            suggestedMax: 40
                                        }
                                    }
                                ]
                            },
                        }              
                    });

                    
                    </script>
                  ";
            
        }
    }
    
    
    
?>