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
    <?php include("modals/caldera/agregar.php");?>
    <?php include("modals/caldera/editar.php");?>
    <?php include("modals/caldera/eliminar.php");?>
    <?php include('nav.php');?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
        <div class="d-flex justify-content-between e3">
          <h3>Consumo Diario</h3>
          <a href="php/acciones/report/report_caldera.php" target="_blank" class="btn btn-primary agregar">
            <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar Día
          </a>
        </div>
        
        <form id="guardarEncabezado" novalidate class="e6">
          <div class="d-flex justify-content-between e3">
            <div class="form-row w-50 e10">
              <div class="form-group col-md-12">
                  <label>Fecha</label>
                  <input type="date" class="form-control" id="fecha" name="fecha" onchange="load(1);" value="<?php echo date("Y-m-d");?>" required>
              </div>
              <div class="form-group col-md-12">
                  <label>Hora Encendido</label>
                  <input type="time" id="hora_encendido" name="hora_encendido" class="form-control">
              </div>
            </div>
            <div class="form-row w-50 e10">
              <div class="form-group col-md-12">
                  <label>Hora Apagado</label>
                  <input type="time" id="hora_apagado" name="hora_apagado" class="form-control">
              </div>
              <div class="form-group col-md-12">
                  <label>Observación General</label>
                  <textarea class="form-control" name="observacion" id="observacion" cols="10" rows="1"></textarea>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <?php if(consulta_acceso_sub_pagina() == 1){?>
              <button type="submit" class="btn btn-primary agregar">
                <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar
              </button>
              <a href="" class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" id="agregar_control">
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
              </a>
              <?php }else{?>
                <button type="submit" class="btn btn-primary agregar" id="save" disabled>
                  <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar
                </button>
                <a href="" class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" id="agregar_control" disabled>
                  <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
                </a>
              <?php }?>
            </div>
        </form>
        <div id="loader" class="text-center"> <img src="img/loader.gif"></div>
        <div class="datos_ajax_delete mt-3"></div><!-- Datos ajax Final -->
        <div class='outer_div table-responsive'></div> 
    </div>
  </div>
              
  <?php include('footer.php');?>
  <script src="js/funciones/caldera.js"></script>

    <script>
      $(document).ready(function(){
        load(1);
        consulta_cuadros(1);
      });
    </script>
</body>
</html>