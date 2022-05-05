<?php 
  session_start();
  require_once("./php/conexion.php");
  $_SESSION['titulo'] = "Caldera";
             
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
                data-pagination="true"
                data-show-toggle="true"
                data-buttons-class="primary"
                data-reorderable-columns="true"
                data-click-to-select="true"
                data-search-selector="#buscar"
                data-id-field="id"
                data-buttons="buttons"
                data-sticky-header="true"
                data-detail-view="true"
                data-detail-view-icon="true"
                data-detail-formatter="detailFormatter"
                data-url="ajax/listar_caldera.php">
                
                <thead class="bg-primary text-light">
                  <tr>
                        <th data-field="id" data-sortable="true" data-visible="false">N°</th>
                        <th data-field="fecha" data-sortable="true">Fecha</th>
                        <th data-field="camiones" data-sortable="true">Turno</th>
                        <th data-field="kilos_mm_pp" data-sortable="true">Hora encendido</th>
                        <th data-field="kilos_producidos" data-sortable="true">Hora apagado</th>
                        <th data-field="rendimiento" data-sortable="true">Observación</th>
<?php 
                      if($edit == 1 || $delete == 1)
                      {
?>
                        <th data-formatter="operateFormatter" data-field="accion">Acción</th>
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
  <?php include('modals/caldera/agregar.php')?>
  <?php include('modals/caldera/editar.php')?>
  <?php include('modals/caldera/eliminar.php')?>
  <?php include('modals/caldera/eliminar_detalle.php')?>
  <?php include('modals/caldera/detalle.php')?>
  <?php include('script.php')?>
  <script src="js/funciones/caldera.js"></script>
  <script>
    $(document).ready(function(){
      diseño();
    });
  </script>
<script>
    var $table = $('#table');
    function operateFormatter(value, row, index) {
<?php
        if($edit == 1 && $delete == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-fecha="'+ row['fecha_0'] +'" data-turno="'+ row['turno'] +'" data-h_encendido="'+ row['encendido'] +'" data-h_apagado="'+ row['apagado'] +'" data-observacion="'+ row['observacion'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-fecha="'+ row['fecha'] +'" title="Eliminar">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>',
            '<a class="text-gray" href="#" data-toggle="modal" data-target="#dataDetalle" data-id="'+ row['id'] +'" title="Detalle">',
              '<i class="fa fa-book pl-3" style="font-size:20px;"></i>',
            '</a>'
          ].join('')
<?php
        }
        else if($edit == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-fecha="'+ row['fecha_0'] +'" data-turno="'+ row['turno'] +'" data-h_encendido="'+ row['encendido'] +'" data-h_apagado="'+ row['apagado'] +'" data-observacion="'+ row['observacion'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>  ',
          ].join('')
<?php
        }
        else if($delete == 1)
        {
?>
          return [
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-fecha="'+ row['fecha'] +'" title="Eliminar">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>'
          ].join('')
<?php 
        }
?>
      
    }

    function detailFormatter(index, row) {
        return childDetail(index,row)  
    }

    function childDetail(index,row){
        var table = document.createElement('table');
        table.setAttribute('class','table align-items-center table-flush');
        table.setAttribute('id',"sub_table"+index);

        var parametros = { "id": row['id'] };
        $.ajax({
            url: 'ajax/listar_detalle_caldera.php',
            data: parametros,
            success: function (data) {
                $('#sub_table'+index).html(data);
            }
        })
        
        return table;
    }

    $("#add").click(function() {
      $("#dataRegister").modal('show');
    });

    function validate(evt) {
        var theEvent = evt || window.event;
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
  </script>
</body>
</html>

