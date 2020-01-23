<?php 
    include('php/funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include("modals/equipos/imagen.php");?>
    <?php include("modals/equipos/agregar.php");?>
    <?php include("modals/equipos/editar.php");?>
    <?php include("modals/equipos/eliminar.php");?>
    <?php include('nav.php');?>

    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-around movil">
                <div class="datos">
                    <p class="inter">Equipos Ingresados</p> 
                    <span class="detalles pro-stock"></span>
                </div>
                <div class="datos">
                    <p class="inter">...</p> 
                    <span class="detalles pro-total"></span>
                </div>
                <div class="datos">
                    <p class="inter">...</p> 
                    <span class="detalles-down"></span>
                </div>
            </div>

            <div class="container-fluid d-flex justify-content-between mt-5">
                <div class="row w-50">
                    <div class="col-xl-8 col-8 p-0">
                        <input class="form-control" id="q" onkeyup="load(1);" type="text" placeholder="Buscar.." autofocus/>
                    </div>
                </div>
                <div class="row d-flex">
                    <button class="btn btn-primary agregar mr-3" id="actualizar">
                        <img src="img/iconos/actualizar.svg" alt="" style="width:34px; margin-right: 14px;"> Actualizar
                    </button>
                    <form action="php/acciones/report/report_equipos.php" target="somewhere_new">
                        <button class="btn btn-primary agregar mr-3" id="exportar">
                            <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar Equipos
                        </button>
                    </form>
                    <?php if(consulta_acceso_pagina() == 1){?>
                        <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister">
                            <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar Equipo
                        </button>
                    <?php }else{?>
                        <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister" disabled>
                            <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar Equipo
                        </button>
                    <?php }?>
                </div>
            </div>

            <div id="loader" class="text-center"> <img src="img/loader.gif"></div>
            <div class="datos_ajax_delete mt-3"></div>
            <div class='outer_div table-responsive'></div>
        </div>    
    </div>
    
    <?php include('footer.php');?>
    <script src="js/funciones/equipos.js"></script>
    <script>
		$(document).ready(function(){
            load(1);
            consulta_cuadros(1);
		});
	</script>
    <script>
        $( "#actualizar" ).click(function() {
            load(1);
            consulta_cuadros(1);
        });
        $( "#exportar" ).click(function() {
            exportar(1);
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