$( "#eliminarDetalle" ).submit(function( event ) {
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "php/acciones/delete/delete_detalle_detencion.php",
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
      url: "php/acciones/delete/delete_detencion.php",
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
        url: "php/acciones/add/add_detencion.php",
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
            $('#camiones0').val('')
            $('#kilos_mm_pp0').val('')
            $('#kilos_producidos0').val('')
            $('#rendimiento0').val('')
            $('#kilos_embolsado0').val('')
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
      url: "php/acciones/add/add_detencion_detalle.php",
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
        url: "php/acciones/update/update_detencion.php",
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
    var camiones = button.data('camiones') 
    var kilos_mm_pp = button.data('kilos_mm_pp') 
    var kilos_producidos = button.data('kilos_producidos')
    var rendimiento = button.data('rendimiento')
    var kilos_embolsado = button.data('kilos_embolsado')

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #fecha').val(fecha)
    modal.find('.modal-body #camiones').val(camiones)
    modal.find('.modal-body #kilos_mm_pp').val(kilos_mm_pp)
    modal.find('.modal-body #kilos_producidos').val(kilos_producidos)
    modal.find('.modal-body #rendimiento').val(rendimiento)
    modal.find('.modal-body #kilos_embolsado').val(kilos_embolsado)
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
