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
    <?php include("modals/requerimientos/agregar.php");?>
    <?php include("modals/requerimientos/editar.php");?>
    <?php include("modals/requerimientos/eliminar.php");?>
    <?php include("modals/requerimientos/responder.php");?>
    <?php include('nav.php');?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
        <div class="d-flex justify-content-between e3">
          <h3>Requerimientos Mantención</h3>
          <a href="php/acciones/report/report_resumen_requerimientos.php" target="_blank" class="btn btn-primary agregar mr-3 e6" id="exportar">
            <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Resumen
          </a>
        </div>
        <div class="row d-flex justify-content-between mt-5 e3">
          <div class="col-sm-7 col-md-7 col-xl-3 e3">
              <input class="form-control" id="q" onkeyup="load(1);" type="text" placeholder="Buscar.." autofocus/>
          </div>
          <div class="e8">
            <button class="btn btn-primary agregar mr-3" id="actualizar">
              <img src="img/iconos/actualizar.svg" alt="" style="width:34px; margin-right: 14px;"> Actualizar
            </button>
            <?php if(consulta_acceso_pagina() == 1){?>
              <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister">
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
              </button>
            <?php }else{?>
              <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" disabled>
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
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
  <script src="js/funciones/requerimientos.js"></script>

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

    <script>
        function handleFileSelect(evt) {
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        $('#img').attr('src', e.target.result);
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }

        document.getElementById('img-edit').addEventListener('change', handleFileSelect, false);
    
    </script>
</body>
</html>