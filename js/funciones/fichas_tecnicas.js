$('#dataUpdate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var nombre = button.data('nombre')
    var uso = button.data('uso')
    var tipo = button.data('tipo')

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #nombre').val(nombre)
    modal.find('.modal-body #uso').val(uso)
    modal.find('select[id=tipo]').val(tipo)
    $('.selectpicker').selectpicker('refresh');
    $('.alert').hide();
})

$('#dataDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id') 
    var nombre = button.data('nombre')

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #nom').text(nombre)
})

$( "#guardarDatos" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#guardarDatos')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      url: "php/acciones/add/add_ficha_tecnica.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        $(".mensaje").show();
        $(".mensaje").html(data);
        setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
        $('#dataRegister').modal('hide');
        $('#nombre0').val('');
        $('#uso0').val('');
        $('#documento0').val('');
        $table.bootstrapTable('refresh');
        $('#fp1').addClass('d-none');
        $('#nombre0').prop('disabled',false);
        $('#nombre0').val('');
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
        url: "php/acciones/update/update_correctivo.php",
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
                url: "php/acciones/delete/delete_correctivo.php",
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

$('#tipo0').on('change', function() {   
    if(this.value == 3)
    {
        $('#fp1').removeClass('d-none');
        $('#nombre0').prop('disabled',true);
    }
    else{
        $('#fp1').addClass('d-none');
        $('#nombre0').prop('disabled',false);
        $('#nombre0').val('');
    }
});

$('#equipos0').on('change', function() {   
    var texto = $( "#equipos0 option:selected" ).text();
    $('#nombre0').val('');
    $('#nombre0').val(texto);
});