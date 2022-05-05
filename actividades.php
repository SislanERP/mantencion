<?php 
  session_start();
  require_once("./php/conexion.php");
  $_SESSION['titulo'] = "Actividades Diarias";
             
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
            <div id="toolbar" class="select">
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
                data-auto-refresh="true"
                data-auto-refresh-interval="3"
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
                data-sticky-header="true"
                data-url="ajax/listar_actividades.php">
                
                <thead class="bg-primary text-light">
                  <tr>
                        <th data-field="id" data-sortable="true" data-visible="false" data-print-ignore="true">N°</th>
                        <th data-field="fecha" data-sortable="true" data-visible="true">Fecha</th>
                        <th data-field="turno" data-sortable="true" data-visible="true">Turno</th>
                        <th data-field="equipo" data-sortable="true">Equipo</th>
                        <th data-field="estado" data-sortable="true">Estado</th>
                        <th data-field="actividad" data-sortable="true">Actividad</th>
                        <th data-field="usuario" data-sortable="true">Trabajador</th>
<?php 
                      if($edit == 1 || $delete == 1)
                      {
?>
                        <th data-formatter="operateFormatter" data-field="accion" data-print-ignore="true">Acción</th>
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
  <?php include('modals/actividades/agregar.php')?>
  <?php include('modals/actividades/editar.php')?>
  <?php include('modals/actividades/eliminar.php')?>
  <?php include('script.php')?>
  <script src="js/funciones/actividades.js"></script>
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
          exportTypes: ['excel', 'pdf'],
          columns: [
            {
              field: 'state',
              checkbox: true,
              visible: $(this).val() === 'selected'
            },
            {
              field: 'fecha',
              title: 'Fecha'
            }, 
            {
              field: 'turno',
              title: 'Turno'
            }, 
            {
              field: 'equipo',
              title: 'Equipo'
            },
            {
              field: 'estado',
              title: 'Estado'
            },
            {
              field: 'actividad',
              title: 'Actividad'
            },
            {
              field: 'usuario',
              title: 'Trabajador'
            },
            {
              field:'accion',
              forceHide: true
            }
          ]
        })
      }).trigger('change')
    })

    $(function() {
    $table.bootstrapTable({
      printPageBuilder: function (table) {
        return `
<html>
  <head>
  <style type="text/css" media="print">
  @page {
    size: auto;
    margin: 25px 0 25px 0;
  }
  </style>
  <style type="text/css" media="all">
  table {
    border-collapse: collapse;
    font-size: 12px;
  }
  table, th, td {
    border: 1px solid grey;
  }
  th, td {
    text-align: center;
    vertical-align: middle;
  }
  p {
    font-weight: bold;
    margin-left:20px;
  }
  table {
    width:94%;
    margin-left:3%;
    margin-right:3%;
  }
  div.bs-table-print {
    text-align:center;
  }
  </style>
  </head>
  <title>Print Table</title>
  <body>
  <div class="bs-table-print">${table}</div>
  </body>
</html>`
      }
    })
  })

    function operateFormatter(value, row, index) {
        var reporte = row['documento'];
<?php
        if($edit == 1 && $delete == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-fecha="'+ row['fecha'] +'" data-turno="'+ row['id_turno'] +'" data-estado="'+ row['id_estado'] +'" data-actividad="'+ row['actividad'] +'" data-detalle="'+ row['detalle'] +'" data-equipo="'+ row['id_equipo'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-actividad="'+ row['actividad'] +'" data-usuario="'+ row['usuario'] +'" title="Remove">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>'
          ].join('')
<?php
        }
        else if($edit == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-fecha="'+ row['fecha'] +'" data-turno="'+ row['id_turno'] +'" data-estado="'+ row['id_estado'] +'" data-actividad="'+ row['actividad'] +'" data-detalle="'+ row['detalle'] +'" data-equipo="'+ row['id_equipo'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a> '
          ].join('')
<?php
        }
        else if($delete == 1)
        {
?>
          return [
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-actividad="'+ row['actividad'] +'" data-usuario="'+ row['usuario'] +'" title="Remove">',
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
</body>
</html>

