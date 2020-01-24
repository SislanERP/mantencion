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
            header("location:index.php");
            exit;
        }
        else
        {
            $_SESSION['tiempo'] = time();
        }
    }
    else
    {
        header("location:index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include("modals/actividades/agregar.php");?>
    <?php include("modals/actividades/editar.php");?>
    <?php include("modals/actividades/eliminar.php");?>
    <?php include('nav.php');?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white" style="background:#fff;border-radius:15px;">
        <div class="d-flex justify-content-between">
          <h3>Actividades Diarias</h3>
          <a href="php/acciones/report/report_actividades.php" target="_blank" class="btn btn-primary agregar">
            <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar Día
          </a>
        </div>

        <div class="row d-flex justify-content-between mt-5">
          <div class="col-sm-7 col-md-7 col-xl-3">
              <input class="form-control" id="q" onchange="load(1);" type="date" value="<?php echo date("Y-m-d");?>" autofocus/>
          </div>
          <div>
            <button class="btn btn-primary agregar mr-3" id="actualizar">
              <img src="img/iconos/actualizar.svg" alt="" style="width:34px; margin-right: 14px;"> Actualizar
            </button>
            <?php if(consulta_acceso_sub_pagina() == 1){?>
              <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister">
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar Actividad
              </button>
            <?php }else{?>
              <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" disabled>
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar Actividad
              </button>
            <?php }?>
          </div>
        </div>

        <div id="loader" class="text-center"> <img src="img/loader.gif"></div>
        <div class="datos_ajax_delete mt-3"></div><!-- Datos ajax Final -->
        <div class='outer_div table-responsive'></div> 
    </div>
  </div>
              
  <?php include('footer.php');?>
  <script src="js/funciones/actividades.js"></script>

    <script>
      $(document).ready(function(){
        load(1);
      });
    </script>
    <script>
      $( "#actualizar" ).click(function() {
          load(1);
      });
    </script>
</body>
</html>