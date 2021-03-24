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
        <div class="d-flex justify-content-between e3">
          <h3>Consulta Caldera</h3>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="col-form-label">Desde:</label>
                    <input type="date" class="form-control" id="desde" name="desde" value="<?=date("Y-m-d")?>">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="col-form-label">Hasta:</label>
                    <input type="date" class="form-control" id="hasta" name="hasta" value="<?=date("Y-m-d")?>">
                </div>
            </div>
            <div class="col-lg-2 d-flex align-items-end">
                <a href="#" id="Buscar" class="btn btn-primary agregar e6">
                    <img src="img/iconos/buscar.svg" alt="" style="width:34px; margin-right: 14px;"> Buscar
                </a>
            </div>
        </div>
        <nav class="mt-4">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-riles-tab" data-bs-toggle="tab" data-bs-target="#nav-riles" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Consumo Gas</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-riles" role="tabpanel" aria-labelledby="nav-riles-tab">
                <div class="gas mt-3 d-flex flex-column">
                
                </div> 
            </div>
        </div>
         
    </div>
  </div>
              
  <?php include('footer.php');?>
  <script>
		$(document).ready(function(){
            load(1);
		});

        function load(page){
            var desde = $("#desde").val();
            var hasta = $("#hasta").val();
            var parametros = {"desde": desde,"hasta": hasta, "page":page};
            $.ajax({
                url:'ajax/listar_consumo_gas.php',
                data: parametros,
                beforeSend: function(objeto){
                    $("#loader").html("<img src='img/loader.gif'>");
                },
                success:function(data){
                    $(".gas").html(data).fadeIn('slow');
                }
            })
        }

        $( "#Buscar" ).click(function() {
            load(1);
        });
    </script>
</body>
</html>