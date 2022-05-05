<?php 
    session_start();
    include('php/conexion.php');
    $_SESSION['titulo'] = "Plantillas";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Sistema Mantención | <?=$_SESSION['titulo']?></title>
  <?php include('head.php')?>
</head>

<body>
    <?php include('menu.php')?>
    <div class="main-content">
        <?php include('nav.php')?>
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
        <div class="container-fluid mt--7 mb-5">
            <div class="row">
                <div class="col" >
                    <div class="card shadow">
                        <div class="resultado">
                            <div id="content">
                                <div class="content-fluid p-5 shadow bg-white e7" style="background:#fff;border-radius:15px;">
                                    <form id="guardarDatos">
                                        <div class="form-row w-100">
                                            <div class="col-md-6 col-sm-12 p-0 e5">
                                                <label>Equipo:</label>
                                                <select class="selectpicker form-control" data-live-search="true" name="equipo" id="equipo" onchange="load(1);">
                                                    <?php 
                                                        $consulta = "call consulta_estado_equipos(4)";
                                                        $resultado = mysqli_query(conectar(), $consulta );
                                                        while ($columna = mysqli_fetch_array( $resultado ))
                                                        { 
                                                            echo    "<option value='".$columna['id_equipo']."'>".$columna['equipo']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-12 align-self-end">
                                                <a data-toggle='modal' data-target="#copiar" class="btn btn-primary agregar text-white">
                                                    Copiar Plantilla
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-12 d-flex justify-content-end align-self-end e3 e6 p-0">
                                                <a data-toggle='modal' data-target="#confirm" class="btn btn-primary agregar text-white">
                                                    Guardar Plantilla
                                                </a>
                                            </div>
                                        </div>
                                                    
                                        
                                    
                                        <div class="col-12 datos_ajax_delete mt-3"></div>
                                            <div class="col-12 p-0">
                                                <textarea name="summernote" id="summernote"></textarea>
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

                                    <form id="CopiarPlantilla">
                                        <div class="modal fade" id="copiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Copiar Plantilla</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group mb-0">
                                                                    <label class="col-form-label">Diseño Plantilla a Copiar:</label>
                                                                    <select name="equipo1" id="equipo1" class="selectpicker form-control" data-live-search="true">
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
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group mb-0">
                                                                    <label class="col-form-label">Copiar Plantilla a Equipo:</label>
                                                                    <select name="equipo2" id="equipo2" class="selectpicker form-control" data-live-search="true">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Copiar Plantilla</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mensaje"></div>

    <?php include('script.php');?>
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="js/funciones/plantilla.js"></script>
    <script>
        $(document).ready(function() {
            load();
            diseño();
            
        });

        
    </script>
</body>
</html>