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
    <?php include("modals/detenciones/agregar.php");?>
    <?php include("modals/detenciones/editar.php");?>
    <?php include("modals/detenciones/eliminar.php");?>
    <?php include('nav.php');?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
        <div class="d-flex justify-content-between e3">
            <h3>Información de Producción y Problemas Mecánicos</h3>
            <a href="php/acciones/report/report_detenciones.php" target="_blank" class="btn btn-primary agregar mr-3 e6" id="exportar">
                <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
            </a>
        </div>
        
        
        <form id="guardarEncabezado" novalidate class="e6">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" onchange="load(1);" value="<?php echo date("Y-m-d");?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label>N° Camiones</label>
                    <input type="number" class="form-control" id="camiones" name="camiones" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Kilos Mm.PP</label>
                    <input type="number" class="form-control" id="kilos_mm_pp" name="kilos_mm_pp" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Kilos Producidos</label>
                    <input type="number" class="form-control" id="kilos_producidos" name="kilos_producidos" required>
                </div>
                <div class="form-group col-md-4">
                    <label>% Rendimiento</label>
                    <input type="number" class="form-control" id="rendimiento" name="rendimiento" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Kilos Producto Embolsado</label>
                    <input type="number" class="form-control" id="kilos_embolsado" name="kilos_embolsado" required>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <?php if(consulta_acceso_pagina() == 1){?>
                    <button type="submit" class="btn btn-primary agregar">
                        <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar
                    </button>
                    <a href="" class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" id="agregar_detencion">
                        <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
                    </a>
                <?php }else{?>
                    <button type="submit" class="btn btn-primary agregar" id="save" disabled>
                        <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar
                    </button>
                    <a href="" class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" id="agregar_detencion" disabled>
                        <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
                    </a>
                <?php }?>
                
            </div>
        </form>

        <div id="loader" class="text-center"> <img src="img/loader.gif"></div>
        <div class="datos_ajax_delete mt-3"></div>
        <div class='outer_div table-responsive'></div> 
    </div>
  </div>
              
  <?php include('footer.php');?>
  <script src="js/funciones/detenciones.js"></script>

    <script>
		$(document).ready(function(){
            load(1);
            consulta_cuadros(1);
		});
    </script>
</body>
</html>