<?php 
  session_start();
  require_once("./php/conexion.php");
  $_SESSION['titulo'] = "Equipos";
      
  if(empty($_SESSION['id_user']) ) {
    echo "<script>location.href='index.php';</script>";
  }

  $buscarUsuario = "call consulta_acceso_funciones('$_SESSION[titulo]',$_SESSION[id_user])";
  $result = conectar()->query($buscarUsuario);
  if ($columna = mysqli_fetch_array( $result ))
  {
      $add = $columna['agregar'];
      $edit = $columna['editar'];
      $delete = $columna['eliminar'];
  }
  
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
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Titulo</h5>
                      <span class="h2 font-weight-bold mb-0">---</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> ---</span>
                    <span class="text-nowrap">---</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Titulo</h5>
                      <span class="h2 font-weight-bold mb-0">---</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> ---</span>
                    <span class="text-nowrap">---</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Titulo</h5>
                      <span class="h2 font-weight-bold mb-0">---</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> ---</span>
                    <span class="text-nowrap">---</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Titulo</h5>
                      <span class="h2 font-weight-bold mb-0">---</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> ---</span>
                    <span class="text-nowrap">---</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7 mb-5">
      <div class="row">
        <div class="col">
          <div class="card shadow pr-3 pl-3">
            <div class="resultado">
              <div id="toolbar">
                <select class="selectpicker form-control" data-live-search="true">
                  <option value="all">Exportar Todo</option>
                  <option value="">Exportar Página</option>
                  <option value="selected">Exportar Selección</option>
                </select>
                
              </div>
<?php 
                if($add == 1)
                {
?>
                <a href="#" id="add" class="btn btn-success float-right" style="margin-top:10px;margin-left:5px;margin-right:0px;"><i class="fas fa-plus-square"></i></a>
<?php
                }
?>
              
              <table class="table align-items-center table-flush"
                id="table" 
                data-toggle="table"
                data-locale="es-CL"
                data-toolbar="#toolbar"
                data-show-refresh="true"
                data-show-columns="true"
                data-show-export="true"
                data-pagination="true"
                data-show-toggle="true"
                data-buttons-class="primary"
                data-show-print="true"
                data-reorderable-columns="true"
                data-click-to-select="true"
                data-search-selector="#buscar"
                data-id-field="id"
                data-buttons="buttons"
                data-url="ajax/listar_equipos.php">
                
                <thead class="bg-primary text-light">
                  <tr>
                      <th data-field="" data-sortable="true"></th>
                      <th data-field="id" data-sortable="true" data-visible="false">Id</th>
                      <th data-field="equipo" data-sortable="true">Equipo</th>
                      <th data-field="marca" data-sortable="true" data-visible="false">Marca</th>
                      <th data-field="ubicacion" data-sortable="true">Ubicación</th>
                      <th data-field="linea" data-sortable="true">Línea</th>
                      <th data-field="estado" data-sortable="true">Estado</th>
<?php 
                      if($edit == 1 || $delete == 1)
                      {
?>
                        <th data-formatter="operateFormatter">Acción</th>
<?php
                      }
?>
                      
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mensaje"></div>
  <?php include('modals/equipos/agregar.php')?>
  <?php include('modals/equipos/editar.php')?>
  <?php include('modals/equipos/eliminar.php')?>
  <?php include('script.php')?>
  <script src="js/funciones/equipos.js"></script>
  <script>
    $(document).ready(function(){
      diseño();
    });
  </script>
  <script>
    var $table = $('#table')

    $(function() {
      $('#toolbar').find('select').change(function () {
        
        $table.bootstrapTable('destroy').bootstrapTable({
          exportDataType: $(this).val(),
          exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
          columns: [
            {
              field: 'state',
              checkbox: true,
              visible: $(this).val() === 'selected'
            }
          ]
        })
      }).trigger('change')
    })

    function operateFormatter(value, row, index) {
<?php
        if($edit == 1 && $delete == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-nombre="'+ row['equipo'] +'" data-marca="'+ row['marca'] +'" data-ubicacion="'+ row['id_ubicacion'] +'" data-linea="'+ row['id_linea'] +'" data-caracteristicas="'+ row['caracteristicas'] +'" data-imagen="'+ row['imagen'] +'" data-img="img'+ row['id'] +'" data-estado="'+ row['id_estado'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-nombre="'+ row['equipo'] +'" title="Remove">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>'
          ].join('')
<?php
        }
        else if($edit == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-nombre="'+ row['equipo'] +'" data-marca="'+ row['marca'] +'" data-ubicacion="'+ row['id_ubicacion'] +'" data-linea="'+ row['id_linea'] +'" data-caracteristicas="'+ row['caracteristicas'] +'" data-imagen="'+ row['imagen'] +'" data-img="img'+ row['id'] +'" data-estado="'+ row['id_estado'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  '
          ].join('')
<?php
        }
        else if($delete == 1)
        {
?>
          return [
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-nombre="'+ row['equipo'] +'" title="Remove">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>'
          ].join('')
<?php 
        }
?>
      
    }

    $("#add").click(function() {
      $("#dataRegister").modal('show');
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