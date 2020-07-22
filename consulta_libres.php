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
    <?php include('modals/consulta_libres/editar.php');?>
    <?php include('modals/consulta_libres/eliminar.php');?>
    <?php consulta_acceso_sub_pagina();?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
        <div class="d-flex justify-content-between e3">
          <h3>Consulta Libres</h3>
          <!-- <a href="php/acciones/report/report_actividades.php" target="_blank" class="btn btn-primary agregar e6">
            <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
          </a> -->
        </div>
        <div class="row d-flex justify-content-between mt-2 e3 align-items-end">
            <div class="d-flex w-75">
                <div class="col-sm-7 col-md-7 col-xl-5 d-flex">
                    <div class="form-group mb-0">
                        <label class="col-form-label">Trabajador:</label>
                        <select name="usuario" id="usuario" class="selectpicker form-control" data-live-search="true" onchange="load(1);">
                        <?php 
                            $consulta = "call consulta_personal_mantencion()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                            echo    "<option value='".$columna['id_usuario']."'>".$columna['nombre']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="resultado mt-3"></div>  
      
        <div class="resultado_libres mt-3"></div>
    </div>
  </div>
              
  <?php include('footer.php');?>
  <script src="js/funciones/consulta_libres.js"></script>
  <script>
		$(document).ready(function(){
            load(1);
		});
    </script>
</body>
</html>