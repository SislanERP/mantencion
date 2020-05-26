<?php 
    session_start();
    require_once("../php/conexion.php");

    $año = $_POST['año'];
    $mes_inicial = $_POST['mes_inicial'];
    $mes_final = $_POST['mes_final'];

    $a[] = array();
    $b[] = array();
    $c[] = array();
    $meses[] = array();

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
                        $a[$i] = 0;
                        $b[$i] = 0;
                        $c[$i] = 0;
                        $meses[$i] = "";
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

                        switch ($i) {
                            case 1:
                                $meses[$i] = "Enero";
                            break;
                            case 2:
                                $meses[$i] = "Febrero";
                            break;
                            case 3:
                                $meses[$i] = "Marzo";
                            break;
                            case 4:
                                $meses[$i] = "Abril";
                            break;
                            case 5:
                                $meses[$i] = "Mayo";
                            break;
                            case 6:
                                $meses[$i] = "Junio";
                            break;
                            case 7:
                                $meses[$i] = "Julio";
                            break;
                            case 8:
                                $meses[$i] = "Agosto";
                            break;
                            case 9:
                                $meses[$i] = "Septiembre";
                            break;
                            case 10:
                                $meses[$i] = "Octubre";
                            break;
                            case 11:
                                $meses[$i] = "Noviembre";
                            break;
                            case 12:
                                $meses[$i] = "Diciembre";
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
                            label: 'Horas Producción',
                            data: $produccion,
                            backgroundColor: 'rgba(0, 99, 132, 0.6)',
                            borderWidth: 0,
                            yAxisID: 'y-axis-density'
                        };
                                
                        var gravityData = {
                            label: 'Porcentaje de paras',
                            data: $porcentaje,
                            backgroundColor: 'rgba(99, 132, 0, 0.6)',
                            borderWidth: 0,
                            yAxisID: 'y-axis-gravity'
                        };
        
                        var Horas = {
                            label: 'Horas parados',
                            data: $horas,
                            borderWidth: 0,
                            yAxisID: 'y-axis-horas'
                        };
                                
                        var planetData = {
                            labels: $data,
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