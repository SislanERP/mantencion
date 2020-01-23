<?php 
    include('php/funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include("modals/reporte/resumen.php");?>
    <?php include("modals/reporte/eliminar.php");?>
    <?php include('nav.php');?>

    <div class="container-fluid">
        <div class="row d-flex justify-content-between espac">
            <div class="col-12 col-lg-5 desta">
                <form class="mt-4 mb-3">
                    <div class="form-group d-flex">
                        <label>Desde </label>
                        <input type="date" id="desde" value="<?php echo date("Y-m-d");?>" class="form-control fec" style="margin-left: 23px;">
                    </div>
                    <div class="form-group d-flex">
                        <label>Hasta </label>
                        <input type="date" id="hasta" value="<?php echo date("Y-m-d");?>" class="form-control fec" style="margin-left: 27px;">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary w-100" id="buscar">Buscar</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-4 desta d-flex justify-content-between align-items-center flex-column expor">
                <h3 class="pt-2">Exportar</h3>
                <div class="form-group">
                    <a href="php/acciones/search/reporte_fechas.php" target="_blank" class="btn btn-primary w-100">Reporte</a>
                </div>
            </div>
        </div>

        <div class="datos_ajax_delete mt-3"></div><!-- Datos ajax Final -->
        <div class='outer_div'></div>
        
    </div>
    <?php include('footer.php');?>
    <script src="js/funciones/reporte.js"></script>
    <script>
        $("#buscar").click( function()
        {
            load(1);
        }
        );
    </script>
    <script>
		$(document).ready(function(){
			load(1);
		});
	</script>
</body>
</html>