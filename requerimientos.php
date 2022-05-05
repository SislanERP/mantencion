<?php 
  session_start();
  require_once("./php/conexion.php");
  $_SESSION['titulo'] = "Requerimientos";
             
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
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
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
                data-url="ajax/listar_requerimientos.php">
                
                <thead class="bg-primary text-light">
                  <tr>
                        <th data-field="" data-sortable="false"></th>
                        <th data-field="id" data-sortable="true" data-visible="true">N°</th>
                        <th data-field="fecha" data-sortable="true">Fecha</th>
                        <th data-field="prioridad" data-sortable="true" data-visible="true">Prioridad</th>
                        <th data-field="trabajador" data-sortable="false" data-visible="true">Responsable</th>
                        <th data-field="estado" data-sortable="false" data-visible="true">Estado</th>
                        <th data-field="log_terminado" data-sortable="false" data-visible="true">Validado</th>
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
  <?php include('modals/requerimientos/agregar.php')?>
  <?php include('modals/requerimientos/editar.php')?>
  <?php include('modals/requerimientos/eliminar.php')?>
  <?php include('modals/requerimientos/responder.php')?>
  <?php include('script.php')?>
  <script src="js/funciones/requerimientos.js"></script>
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
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-actividad="'+ row['actividad'] +'" data-imagen="'+ row['imagen'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" title="Remove">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>',
            '<a href="#" data-toggle="modal" data-target="#dataResponder" data-id="'+ row['id'] +'" data-actividad="'+ row['actividad'] +'" data-imagen="'+ row['imagen'] +'" data-prioridad="'+ row['id_prioridad'] +'" data-estado="'+ row['id_estado'] +'" data-desarrollo="'+ row['desarrollo'] +'" data-terminado="'+ row['log_terminado'] +'" data-responsable="'+ row['id_trabajador'] +'"><i class="fas fa-book pl-3" style="font-size:20px;color:#000;"></i></a>'
          ].join('')
<?php
        }
        else if($edit == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-actividad="'+ row['actividad'] +'" data-imagen="'+ row['imagen'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
            '<a href="#" data-toggle="modal" data-target="#dataResponder" data-id="'+ row['id'] +'" data-actividad="'+ row['actividad'] +'" data-imagen="'+ row['imagen'] +'" data-prioridad="'+ row['id_prioridad'] +'" data-estado="'+ row['id_estado'] +'" data-desarrollo="'+ row['desarrollo'] +'" data-terminado="'+ row['log_terminado'] +'" data-responsable="'+ row['id_trabajador'] +'"><i class="fas fa-book pl-3" style="font-size:20px;color:#000;"></i></a>'
          ].join('')
<?php
        }
        else if($delete == 1)
        {
?>
          return [
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" title="Remove">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>',
            '<a href="#" data-toggle="modal" data-target="#dataResponder" data-id="'+ row['id'] +'" data-actividad="'+ row['actividad'] +'" data-imagen="'+ row['imagen'] +'" data-prioridad="'+ row['id_prioridad'] +'" data-estado="'+ row['id_estado'] +'" data-desarrollo="'+ row['desarrollo'] +'" data-terminado="'+ row['log_terminado'] +'" data-responsable="'+ row['id_trabajador'] +'"><i class="fas fa-book pl-3" style="font-size:20px;color:#000;"></i></a>'
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

