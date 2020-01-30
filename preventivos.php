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
    <?php include("modals/preventivos/agregar.php");?>
    <?php include("modals/preventivos/editar.php");?>
    <?php include("modals/preventivos/eliminar.php");?>
    <?php include('nav.php');?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
        <h3>Preventivos Programados</h3>
        <div class="row d-flex justify-content-between mt-5 e3">
          <div class="col-sm-7 col-md-7 col-xl-3 e3">
              <input class="form-control" id="q" onkeyup="load(1);" type="text" placeholder="Buscar.." autofocus/>
          </div>
          <div class="e8">
            <button class="btn btn-primary agregar mr-3" id="actualizar">
              <img src="img/iconos/actualizar.svg" alt="" style="width:34px; margin-right: 14px;"> Actualizar
            </button>
            <!-- <?php if(consulta_acceso_sub_pagina() == 1){?>
              <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister">
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
              </button>
            <?php }else{?>
              <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" disabled>
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
              </button>
            <?php }?> -->
          </div>
        </div>

        <div id="loader" class="text-center"> <img src="img/loader.gif"></div>
        <div class="datos_ajax_delete mt-3"></div><!-- Datos ajax Final -->
        <div class='outer_div table-responsive'></div> 
    </div>
  </div>
              
  <?php include('footer.php');?>
  <script src="js/funciones/preventivos.js"></script>

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