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

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
        <h3>Fichas Preventivas</h3>
        <form id="guardarDatos">
            <div class="form-row">
                <div class="form-group">
                    <div class="d-flex align-items-end e9">
                        <div class="col-4 p-0 e5">
                            <label>Equipo:</label>
                            <select class="selectpicker form-control" data-live-search="true" name="equipo" id="equipo" onchange="load(1);">
                                <?php 
                                    $consulta = "call consulta_equipos()";
                                    $resultado = mysqli_query(conectar(), $consulta );
                                    while ($columna = mysqli_fetch_array( $resultado ))
                                    { 
                                        echo    "<option value='".$columna['id_equipo']."'>".$columna['equipo']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-8 d-flex justify-content-end e3 e6">
                            <a data-toggle='modal' data-target="#confirm" class="btn btn-primary agregar">
                                <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar Plantilla
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 datos_ajax_delete mt-3"></div>
                <div class="col-12">
                    <textarea name="editor" id="editor" class="tinymce"></textarea>
                </div>
            </div>

            <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">¿Esta Seguro?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Seleccione <b>"Seguro"</b> si está listo para guardar la plantilla.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Seguro</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>

  
              
  <?php include('footer.php');?>
  <script src="js/funciones/plantilla.js"></script>

    <script>
		$(document).ready(function(){
            load(1);
		});
    </script>
</body>
</html>