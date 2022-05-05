$( "#eliminarDetalle" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "php/acciones/delete/delete_detalle_caldera.php",
      data: parametros,
      success: function(datos){
        $(".mensaje").show();
        $(".mensaje").html(datos);
        setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
        $('#dataDeleteDetalle').modal('hide');
        $table.bootstrapTable('refresh');
      }
    });
    event.preventDefault();
});

$( "#eliminarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "php/acciones/delete/delete_caldera.php",
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

$( "#guardarDatos" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#guardarDatos')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        url: "php/acciones/add/add_caldera.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $(".mensaje").show();
            $(".mensaje").html(data);
            setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
            $('#dataRegister').modal('hide');

            $('#fecha0').val('')
            $('#h_encendido0').val('')
            $('#h_apagado0').val('')
            $('#observacion0').val('')
            $('select[name=turno0]').val('default');
            $table.bootstrapTable('refresh');
        }
    });
    event.preventDefault();
});

$( "#guardarDetalle" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#guardarDetalle')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      url: "php/acciones/add/add_caldera_detalle.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        $(".mensaje").show();
        $(".mensaje").html(data);
        setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
        $('#dataDetalle').modal('hide');
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
        url: "php/acciones/update/update_caldera.php",
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

$('#dataUpdate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id')
    var fecha = button.data('fecha') 
    var turno = button.data('turno') 
    var h_encendido = button.data('h_encendido') 
    var h_apagado = button.data('h_apagado')
    var observacion = button.data('observacion')

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #fecha').val(fecha)
    modal.find('select[id=turno]').val(turno)
    modal.find('.modal-body #h_encendido').val(h_encendido)
    modal.find('.modal-body #h_apagado').val(h_apagado)
    modal.find('.modal-body #observacion').val(observacion)
    $('.selectpicker').selectpicker('refresh');
    $('.alert').hide();
})

$('#dataDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id') 
    var fecha = button.data('fecha')

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #fec').text(fecha)
})


$('#dataDeleteDetalle').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id') 

    var modal = $(this)
    modal.find('.modal-body #id_detalle').val(id)
})


$('#dataDetalle').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id') 

    var modal = $(this)
    modal.find('.modal-body #id_d').val(id)
})
