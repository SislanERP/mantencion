<?php 
    include('php/funciones.php');
?>

<?php
    $inactivo = 1800;
 
    if(isset($_SESSION['id_user']) ) {
        $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            echo "<script>location.href='index.php';</script>";
            die();
        }
        else
        {
            $_SESSION['tiempo'] = time();
        }
    }
    else
    {
        echo "<script>location.href='index.php';</script>";
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include('nav.php');?>
    <?php include('modals/indicadores/detalle.php');?>

    <div id="content">
        <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
            <div class="d-flex justify-content-between e3 mb-5">
                <h3>Graficos</h3>
                <!-- <a href="php/acciones/report/report_actividades.php" target="_blank" class="btn btn-primary agregar e6">
                    <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
                </a> -->
            </div>

            <form id="Consulta">
                <div class="col-12 d-flex mb-5">
                    <div class="mb-1 col-2">
                        <label class="w-50">Mes Inicial:</label>
                        <select name="mes_inicial" id="mes_inicial" class="selectpicker form-control" data-live-search="true">
                        <?php 
                            $consulta = "call consulta_meses()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                                echo    "<option value='".$columna['id_mes']."'>".$columna['mes']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-2">
                        <label class="w-50">Mes Final:</label>
                        <select name="mes_final" id="mes_final" class="selectpicker form-control" data-live-search="true">
                        <?php 
                            $consulta = "call consulta_meses()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                                echo    "<option value='".$columna['id_mes']."'>".$columna['mes']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-2">
                        <label class="w-50">Año:</label>
                        <input type="number" name="año" id="año" class="form-control" value="<?php echo date("Y");?>">
                    </div>
                    <div class="col-2 d-flex align-items-end">
                        <button class="btn btn-primary agregar mr-3" type="submit">
                            <img src="img/iconos/actualizar.svg" alt="" style="width:34px; margin-right: 14px;"> Ejecutar
                        </button>
                    </div>
                </div>
            </form>

            <nav class="mt-4">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="equipos-tab" data-toggle="tab" href="#equipos" role="tab" aria-controls="equipos" aria-selected="true">% Paras</a>
                <a class="nav-item nav-link" id="areas-tab" data-toggle="tab" href="#areas" role="tab" aria-controls="areas" aria-selected="false">% Por Áreas</a>
                <a class="nav-item nav-link" id="hp-tab" data-toggle="tab" href="#hp" role="tab" aria-controls="hp" aria-selected="false">% Por total de HP</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="equipos" role="tabpanel" aria-labelledby="equipos-tab">
                    <canvas id="myChart" width="400" height="200px"></canvas>
                    <div class="grafico" id="grafico"></div>
                </div>
                <div class="tab-pane fade" id="areas" role="tabpanel" aria-labelledby="areas-tab">
                    <canvas id="myChart1" width="400" height="200px"></canvas>
                    <div class="grafico1" id="grafico1"></div>
                </div>
                <div class="tab-pane fade" id="hp" role="tabpanel" aria-labelledby="hp-tab">
                    <canvas id="myChart2" width="400" height="200px"></canvas>
                    <div class="grafico2" id="grafico2"></div>
                </div>
            </div>   

            <div class="alert alert-danger alert-dismissible" role="alert" id="error" style="display:none">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> 
                    Debe ingresar todos los campos que se solicitan.
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert" id="menor" style="display:none">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> 
                    Mes Final debe ser mayor que Mes Inicial.
            </div>                                         
            

            
            
        </div>
    </div>
              
  <?php include('footer.php');?>
  <script>
        $( "#Consulta" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#Consulta')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "ajax/consulta_grafico_porcentaje_paras.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if(data == 1)
                {
                    $("#error").show();
                    setTimeout(function() { $('#error').fadeOut('fast'); }, 3000);
                }

                else if(data == 2)
                {
                    $("#menor").show();
                    setTimeout(function() { $('#menor').fadeOut('fast'); }, 3000);
                }

                else
                {
                    $("#myChart").remove();

                    divParent = document.getElementById('grafico');
                    divParent.innerHTML = '<canvas id="myChart"></canvas>';

                    $("#myChart").html(data);
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax/consulta_grafico_paras_equipos.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if(data == 1)
                {
                    $("#error").show();
                    setTimeout(function() { $('#error').fadeOut('fast'); }, 3000);
                }

                else if(data == 2)
                {
                    $("#menor").show();
                    setTimeout(function() { $('#menor').fadeOut('fast'); }, 3000);
                }

                else
                {
                    $("#myChart1").remove();

                    divParent = document.getElementById('grafico1');
                    divParent.innerHTML = '<canvas id="myChart1"></canvas>';

                    $("#myChart1").html(data);
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax/consulta_grafico_paras_equipos_100.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if(data == 1)
                {
                    $("#error").show();
                    setTimeout(function() { $('#error').fadeOut('fast'); }, 3000);
                }

                else if(data == 2)
                {
                    $("#menor").show();
                    setTimeout(function() { $('#menor').fadeOut('fast'); }, 3000);
                }

                else
                {
                    $("#myChart2").remove();

                    divParent = document.getElementById('grafico2');
                    divParent.innerHTML = '<canvas id="myChart2"></canvas>';

                    $("#myChart2").html(data);
                }
            }
        });
        
        event.preventDefault();
    });
  </script>
</body>
</html>