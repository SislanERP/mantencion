<?php 
    session_start();
    require_once("../php/conexion.php");

    $año = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
    $a[] = array();
    $b[] = array();
    $c[] = array();

    for($i=1; $i<=12; $i++)
    {
        $consulta = "call consulta_grafico_anual($año,$i)";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        {
            if(empty($columna['total']))
            {
                $a[$i] = 0;
                $b[$i] = 0;
                $c[$i] = 0;
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
                $a[$i] = round($por_paras,2);
                $b[$i] = $q[0];
                $c[$i] = $v_HorasPartes[0];
            }
            
        }
    }

    

        echo "
            <script>
                var densityCanvas = document.getElementById('myChart');

                Chart.defaults.global.defaultFontFamily = 'Lato';
                Chart.defaults.global.defaultFontSize = 15;

                var densityData = {
                    label: 'Horas Producción',
                    data: [$b[1],$b[2],$b[3],$b[4],$b[5],$b[6],$b[7],$b[8],$b[9],$b[10],$b[11],$b[12]],
                    backgroundColor: 'rgba(0, 99, 132, 0.6)',
                    borderWidth: 0,
                    yAxisID: 'y-axis-density'
                };
                        
                var gravityData = {
                    label: 'Porcentaje de paras',
                    data: [$a[1],$a[2],$a[3],$a[4],$a[5],$a[6],$a[7],$a[8],$a[9],$a[10],$a[11],$a[12]],
                    backgroundColor: 'rgba(99, 132, 0, 0.6)',
                    borderWidth: 0,
                    yAxisID: 'y-axis-gravity'
                };

                var Horas = {
                    label: 'Horas parados',
                    data: [$c[1],$c[2],$c[3],$c[4],$c[5],$c[6],$c[7],$c[8],$c[9],$c[10],$c[11],$c[12]],
                    borderWidth: 0,
                    yAxisID: 'y-axis-horas'
                };
                        
                var planetData = {
                    labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    datasets: [densityData, gravityData]
                };

                var chartOptions = {
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
                                    suggestedMax: 100
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Porcentaje'
                                },
                                id: 'y-axis-gravity'
                            }
                        ]
                    }
                };

                var barChart = new Chart(densityCanvas, {
                    type: 'bar',
                    data: planetData,
                    options: chartOptions,
                    
                });
            </script>
          ";
    

    
?>