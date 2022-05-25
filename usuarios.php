<?php 
  session_start();
  require_once("php/conexion.php");
  $_SESSION['titulo'] = "Usuarios";

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
  <title>Sistema | <?=$_SESSION['titulo']?></title>
  <?php include('head.php')?>
</head>
<body>
  <?php include('menu.php')?>
  <div class="main-content">
    <?php include('nav.php')?>
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
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
                data-buttons-class="primary"
                data-reorderable-columns="true"
                data-click-to-select="true"
                data-search-selector="#buscar"
                data-id-field="id"
                data-buttons="buttons"
                data-sticky-header="true"
                data-url="ajax/listar_usuarios.php">
                
                <thead class="bg-primary text-light">
                  <tr>
                        <th data-field="id" data-visible="false">N°</th>
                        <th data-field="nombre">Nombre</th>
                        <th data-field="correo">Correo</th>
                        <th data-field="telefono">Teléfono</th>
                        <th data-field="direccion">Dirección</th>
                        <th data-field="perfil">Perfil</th>
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
  <?php include('modals/usuarios/agregar.php')?>
  <?php include('modals/usuarios/editar.php')?>
  <?php include('modals/usuarios/eliminar.php')?>
  <?php include('script.php')?>
  <script src="js/funciones/usuarios.js"></script>
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
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-perfil="'+ row['id_perfil'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>',
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-nombre="'+ row['nombre'] +'" title="Eliminar">',
              '<i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>',
            '</a>'
          ].join('')
<?php
        }
        if($edit == 1)
        {
?>
          return [
            '<a class="text-primary" href="#" data-toggle="modal" data-target="#dataUpdate" data-id="'+ row['id'] +'" data-perfil="'+ row['id_perfil'] +'" title="Editar">',
              '<i class="fas fa-pencil-alt pr-1" style="font-size:20px;"></i>',
            '</a>'
          ].join('')
<?php 
        }
        if($delete == 1)
        {
?>
          return [
            '<a class="text-danger" href="#" data-toggle="modal" data-target="#dataDelete" data-id="'+ row['id'] +'" data-nombre="'+ row['nombre'] +'" title="Eliminar">',
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
    function session()
    {
      $.ajax({
        url: "refrescar.php",
        data: {},
        success: function(data) 
        {
          
        }
      });
    }
      
    var validateSession = setInterval(session,60000); //cada 1 minuto
  </script>
</body>
</html>

