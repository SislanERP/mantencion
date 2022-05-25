$('#dataRegister').on('show.bs.modal', function (event) {
  $("#nombre0").val('');
  $("#correo0").val('');
  $('select[name=perfil0]').val('default');
  $('.selectpicker').selectpicker('refresh');
  setTimeout(function (){
    $('#nombre0').focus();
  }, 500);
})
  
$('#dataUpdate').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var perfil = button.data('perfil')
  
  var modal = $(this)
  modal.find('.modal-body #id').val(id)
  modal.find('select[id=perfil]').val(perfil)
  $('.selectpicker').selectpicker('refresh');
  $('.alert').hide();
})
    
  
$('#dataDelete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id') 
  var nombre = button.data('nombre')
  
  var modal = $(this)
  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #user').html(nombre)
})
  
$( "#guardarDatos" ).submit(function( event ) {
  event.preventDefault();
  var form = $('#guardarDatos')[0];
  var data = new FormData(form);
  
  $.ajax({
    type: "POST",
    url: "php/acciones/add/add_usuario.php",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      $(".mensaje").show();
      $(".mensaje").html(data);
      setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
      $table.bootstrapTable('refresh');
      $('#dataRegister').modal('hide');
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
    url: "php/acciones/update/update_usuario.php",
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
    url: "php/acciones/delete/delete_usuario.php",
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