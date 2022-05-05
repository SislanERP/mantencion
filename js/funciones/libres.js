$('#dataUpdate').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var nombre = button.data('id_usuario')
  var fecha = button.data('fecha_trabajada')

  var modal = $(this)
  modal.find('.modal-title').text('Editar')
  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #fecha_trabajada').val(fecha)
  modal.find('select[id=trabajador]').val(nombre)
  $('.selectpicker').selectpicker('refresh');
  $('.alert').hide();
})
  
$('#dataDelete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
  var nombre = button.data('nombre')
  var fecha = button.data('fecha')

  var modal = $(this)
  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #nom').text(nombre)
  modal.find('.modal-body #fec').text(fecha)
})

$( "#guardarDatos" ).submit(function( event ) {
  event.preventDefault();
  var form = $('#guardarDatos')[0];
  var data = new FormData(form);
  
  $.ajax({
    type: "POST",
    url: "php/acciones/add/add_libre.php",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      $(".mensaje").show();
      $(".mensaje").html(data);
      setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
      $('#dataRegister').modal('hide');
      $table.bootstrapTable('refresh');
    }
  });
          
  event.preventDefault();
});

$( "#actualidarDatos" ).submit(function( event ) {
  event.preventDefault();
  var form = $('#actualidarDatos')[0];
  var data = new FormData(form);
  
  $.ajax({
    type: "POST",
    url: "php/acciones/update/update_libre.php",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      $(".mensaje").show();
      $(".mensaje").html(data);
      setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
      $('#dataUpdate').modal('hide');
      $table.bootstrapTable('refresh');
    }
  });

  event.preventDefault();
});

$( "#eliminarDatos" ).submit(function( event ) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "php/acciones/delete/delete_libre.php",
    data: parametros,
    success: function(datos){
      $(".mensaje").show();
      $(".mensaje").html(datos);
      setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
      $('#dataDelete').modal('hide');
      $table.bootstrapTable('refresh');
    }
  });

  event.preventDefault();
});