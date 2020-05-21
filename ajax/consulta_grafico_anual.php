<?php 
    session_start();
    require_once("../php/conexion.php");

    $año = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
    $a[] = array();
    $b[] = array();

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
            }
            else
            {
                $hora_produccion = 18360;
                $horaEntrada = $columna['total'];	
                $v_HorasPartes = explode(":", $horaEntrada);
                $minutosTotales= ($v_HorasPartes[0] * 60) + $v_HorasPartes[1];
                $por_paras = $minutosTotales * 100 / $hora_produccion;
                $a[$i] = $por_paras;
                $b[$i] = $hora_produccion;
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
                    data: [$a[1],$a[2],$a[3],$a[4],$a[5],$a[6],$a[7],$a[8],$a[9],$a[10],$a[11],$a[12]],
                    backgroundColor: 'rgba(0, 99, 132, 0.6)',
                    borderWidth: 0,
                    yAxisID: 'y-axis-density'
                };
                        
                var gravityData = {
                    label: '% de Paras',
                    data: [$b[1],$b[2],$b[3],$b[4],$b[5],$b[6],$b[7],$b[8],$b[9],$b[10],$b[11],$b[12]],
                    backgroundColor: 'rgba(99, 132, 0, 0.6)',
                    borderWidth: 0,
                    yAxisID: 'y-axis-gravity'
                };
                        
                var planetData = {
                    labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    datasets: [densityData, gravityData]
                };
                

                var chartOptions = {
                    scales: {
                        xAxes: [{
                            barPercentage: 1,
                            categoryPercentage: 0.4
                        }],
                        yAxes: [{
                            id: 'y-axis-density'
                        }, {
                            id: 'y-axis-gravity'
                        }]
                    }
                };

                var barChart = new Chart(densityCanvas, {
                    type: 'bar',
                    data: planetData,
                    options: chartOptions
                });
            </script>
          ";
    

    
?>