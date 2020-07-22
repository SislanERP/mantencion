function load(page){
    var query=$("#usuario").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/consulta_libres.php',
        data: parametros,
         beforeSend: function(objeto){
        $("#loader").html("<img src='img/loader.gif'>");
        },
        success:function(data){
            $(".resultado_libres").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}

$('#dataUpdate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id') 

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    $('.alert').hide();
})

$( "#actualidarDatos" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#actualidarDatos')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "php/acciones/update/update_consulta_libres.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        $(".resultado").show();
        $(".resultado").html(data);
        setTimeout(function() { $('.resultado').fadeOut('fast'); }, 3000);
        $('#dataUpdate').modal('hide');
        load();
      }
    });
      event.preventDefault();
  });

  $('#dataDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var fecha = button.data('fecha') 

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #dia').text(fecha)
  })

  $( "#eliminarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
         $.ajax({
                type: "POST",
                url: "php/acciones/delete/delete_consulta_libres.php",
                data: parametros,
                success: function(datos){
                  $(".resultado").show();
                  $(".resultado").html(datos);
                  setTimeout(function() { $('.resultado').fadeOut('fast'); }, 3000);
                  $('#dataDelete').modal('hide');
                  load();
              }
        });
      event.preventDefault();
    });