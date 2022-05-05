<?php 
  session_start();
  require_once("./php/conexion.php");
  $_SESSION['titulo'] = "Indicadores";
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
        <div class="col">
          <div class="card shadow pr-3 pl-3">
            <div class="resultado">
              <form id="Paras">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                      <div class="d-flex flex-column">
                        <label class="col-form-label">Mes:</label>
                        <select name="mes" id="mes" class="selectpicker form-control" data-live-search="true">
                          <?php 
                            $consulta = "call consulta_meses()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                              echo    "<option value='".$columna['id_mes']."'>".$columna['mes']."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-2">
                      <div class="d-flex flex-column">
                        <label class="col-form-label">Año:</label>
                        <input type="number" class="form-control" name="año" id="año" value="<?php echo date("Y");?>">
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-2 d-flex align-items-end mt-3">
                      <button class="btn btn-primary w-100" type="submit">Ejecutar</button>
                    </div>
                </div>
              </form>  
              <div class="w-100 mt-5 mb-5" id="chartdiv" style="height:700px;"></div>        
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mensaje"></div>
  <!-- MODAL DETALLE-->
  <?php include('script.php')?>
  <?php include('modals/indicadores/detalle.php');?>
  <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/dataviz.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
  <script src="js/funciones/indicadores.js"></script>
  <script>
    $(document).ready(function(){
      diseño();
    });
  </script>
  <script>
    $('#Detalle').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      
      var equipo = button.data('equipo')
      var menor = button.data('menor')
      var mayor = button.data('mayor')
      var id = button.data('id')
      var tiempo = button.data('tiempo')

      var modal = $(this)
      modal.find('.modal-title').text(equipo)
      modal.find('.modal-body #id').val(id)
      
      $.ajax({
            type: "POST",
            url: "ajax/consulta_detalle_indicadores.php",
            data: {menor:menor,mayor:mayor,id:id,tiempo:tiempo},
            success: function (data) {
              $(".result").show();
              $(".result").html(data);
            }
      });
    })
  </script>
  
</body>
</html>

