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
                <a href="php/acciones/report/report_actividades.php" target="_blank" class="btn btn-primary agregar e6">
                    <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
                </a>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Anual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Mensual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Diario</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                    <canvas id="myChart" width="400" height="200px"></canvas>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
            </div>

            <div class="grafico"></div>
            
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
        url: "ajax/consulta_grafico_anual.php",
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
                $(".grafico").html(data);
            }
        }
        });
        
        event.preventDefault();
    });
  </script>
</body>
</html>