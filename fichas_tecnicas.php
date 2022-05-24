<?php 
  session_start();
  require_once("./php/conexion.php");
  $_SESSION['titulo'] = "Fichas Técnicas";
             
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
                data-url="ajax/listar_fichas_tecnicas.php">
                
                <thead class="bg-primary text-light">
                  <tr>
                        <th data-field="" data-sortable="false"></th>
                        <th data-field="id" data-sortable="true" data-visible="true">N°</th>
                        <th data-field="tipo" data-sortable="true">Tipo Ficha</th>
                        <th data-field="nombre" data-sortable="true" data-visible="true">Nombre</th>
                        <th data-field="uso" data-sortable="false" data-visible="true">Uso</th>
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
  <?php include('modals/fichas_tecnicas/agregar.php')?>
  <?php include('modals/fichas_tecnicas/editar.php')?>
  <?php include('modals/fichas_tecnicas/eliminar.php')?>
  <?php include('script.php')?>
  <script src="js/funciones/fichas_tecnicas.js"></script>
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
        var reporte = row['documento'];
<?php
        if($edit == 1 && $delete == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-tipo="'+ row['id_tipo_ficha'] +'" data-nombre="'+ row['nombre'] +'" data-uso="'+ row['uso'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-nombre="'+ row['nombre'] +'" title="Remove">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>',
            '<a href="'+ reporte +'" target="_blank"><i class="fas fa-file-pdf pl-3" style="font-size:20px;color:#000;"></i></a>'
          ].join('')
<?php
        }
        else if($edit == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-tipo="'+ row['id_tipo_ficha'] +'" data-nombre="'+ row['nombre'] +'" data-uso="'+ row['uso'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
            '<a href="'+ reporte +'" target="_blank"><i class="fas fa-file-pdf pl-3" style="font-size:20px;color:#000;"></i></a>'
          ].join('')
<?php
        }
        else if($delete == 1)
        {
?>
          return [
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-nombre="'+ row['nombre'] +'" title="Remove">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>',
            '<a href="'+ reporte +'" target="_blank"><i class="fas fa-file-pdf pl-3" style="font-size:20px;color:#000;"></i></a>'
          ].join('')
<?php 
        }
?>
      
    }

    $("#add").click(function() {
      $("#dataRegister").modal('show');
    });
  </script>
</body>
</html>

