<?php 
    include('php/funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include("modals/sala_maquinas/agregar.php");?>
    <?php include("modals/sala_maquinas/editar.php");?>
    <?php include("modals/sala_maquinas/eliminar.php");?>
    <?php include('nav.php');?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white" style="background:#fff;border-radius:15px;">
        <div class="d-flex justify-content-between">
        <h3>Control Sala de Maquinas</h3>
          <form action="php/acciones/report/report_sala_maquinas.php" target="somewhere_new">
            <button type="submit" class="btn btn-primary agregar">
              <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar Día
            </button>
          </form>
        </div>
        
        <form id="guardarEncabezado" novalidate>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" onchange="load(1);" value="<?php echo date("Y-m-d");?>" required>
                </div>
                <div class="form-group col-md-8">
                    <label>Observación</label>
                    <textarea name="observacion" id="observacion" cols="10" rows="2" class="form-control"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <?php if(consulta_acceso_sub_pagina() == 1){?>
                    <button type="submit" class="btn btn-primary agregar">
                        <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar datos
                    </button>
                    <a href="" class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" id="agregar_detencion">
                        <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar Control
                    </a>
                <?php }else{?>
                    <button type="submit" class="btn btn-primary agregar" id="save" disabled>
                        <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar datos
                    </button>
                    <a href="" class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" id="agregar_detencion" disabled>
                        <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar Control
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
  <script src="js/funciones/sala_maquinas.js"></script>

    <script>
		$(document).ready(function(){
            load(1);
            consulta_cuadros(1);
		});
    </script>
</body>
</html>