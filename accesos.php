<?php
    session_start();
    include("php/conexion.php");
    $_SESSION['titulo'] = "Accesos";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Sistema Mantención | <?=$_SESSION['titulo']?></title>
  <?php include('head.php')?>
</head>

<body>
    
    <?php include("menu.php");?>

    <div class="main-content">
        <?php include("nav.php");?>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow pb-4">
                        <div class="card-header border-0">
                            <div class="row align-items-end">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <form id="guardarDatos">
                                        <div class="form-row">
                                            <div class="form-group w-100">
                                                <div class="d-flex align-items-end e9">
                                                    <div class="col-4 p-0 e5">
                                                        <label>Usuario:</label>
                                                        <select class="selectpicker form-control" data-live-search="true" name="usuario" id="usuario" onchange="load(1);">
                                                            <?php 
                                                                $consulta = "call consulta_usuarios()";
                                                                $resultado = mysqli_query(conectar(), $consulta );
                                                                while ($columna = mysqli_fetch_array( $resultado ))
                                                                { 
                                                                    echo    "<option value='".$columna['id_usuario']."'>".$columna['nombre']."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-8 d-flex justify-content-end e3 e6">
                                                        <button type="submit" class="btn btn-primary agregar">
                                                            <img src="img/iconos/guardar.svg" alt="" style="width:34px; margin-right: 14px;"> Guardar Acceso
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='outer_div table-responsive'></div> 
                                    </form>
                                </div>
                            </div>
                            <!-- <div class="resultado mt-4"></div> -->
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="mensaje"></div>
    <?php include("script.php");?>
    <script src="js/funciones/accesos.js"></script>

    <script>
      $(document).ready(function(){
          diseño();
          load(1);
          $("#buscar").keypress(function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                }
            });
      });
    </script>
</body>

</html>