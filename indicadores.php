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
        <div class="d-flex justify-content-between e3">
          <h3>Indicadores</h3>
          <!-- <a href="php/acciones/report/report_actividades.php" target="_blank" class="btn btn-primary agregar e6">
            <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
          </a> -->
        </div>
      <form id="Paras">
        <div class="row d-flex justify-content-between mt-2 e3 align-items-end">
          <div class="d-flex w-75">
            <div class="col-sm-7 col-md-7 col-xl-5 d-flex">
              <div class="form-group mb-0">
                <label class="col-form-label">Mes:</label>
                <select name="mes" id="mes" class="selectpicker form-control" data-live-search="true">
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
              <div class="form-group mb-0 ml-4">
                    <label class="col-form-label">Año:</label>
                    <input type="number" class="form-control" name="año" id="año" value="<?php echo date("Y");?>">
              </div>
            </div>
          </div>
          <div class="e8">
            <button class="btn btn-primary agregar mr-3" type="submit">
              <img src="img/iconos/actualizar.svg" alt="" style="width:34px; margin-right: 14px;"> Ejecutar
            </button>
          </div>
        </div>
      </form>           
      <nav class="mt-4">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="equipos-tab" data-toggle="tab" href="#equipos" role="tab" aria-controls="equipos" aria-selected="true">Por Equipos</a>
          <a class="nav-item nav-link" id="areas-tab" data-toggle="tab" href="#areas" role="tab" aria-controls="areas" aria-selected="false">Por Áreas</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="equipos" role="tabpanel" aria-labelledby="equipos-tab">
          <div class="resultado_equipos mt-3"></div>
        </div>
        <div class="tab-pane fade" id="areas" role="tabpanel" aria-labelledby="areas-tab">
          <div class="resultado_ubicacion mt-3"></div>
        </div>
      </div>   
        
    </div>
  </div>
              
  <?php include('footer.php');?>
  <script src="js/funciones/indicadores.js"></script>
  <script>
    $('#Detalle').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      
      var equipo = button.data('equipo')
      var menor = button.data('menor')
      var mayor = button.data('mayor')
      var id = button.data('id')
      var tiempo = button.data('tiempo')

      var modal = $(this)
      modal.find('.modal-title').text(equipo)
      modal.find('.modal-body #id').val(id)
      
      $.ajax({
            type: "POST",
            url: "ajax/consulta_detalle_indicadores.php",
            data: {menor:menor,mayor:mayor,id:id,tiempo:tiempo},
            success: function (data) {
              $(".result").show();
              $(".result").html(data);
            }
      });
  })
  </script>
</body>
</html>