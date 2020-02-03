function load(page) {
    var equipo=$("#equipo").val();
    var parametros = { "action": "ajax", "page": page,'equipo':equipo };
    $.ajax({
        url: 'ajax/consulta_plantilla_equipo.php',
        data: parametros,
        dataType: "json",
        success: function (data) {
            $('#summernote').summernote();
            $('#summernote').summernote('code', data[0]);
        },
        error: function() {
            $('#summernote').summernote('code', '');
        }
    })
}

$( "#guardarDatos" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#guardarDatos')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      url: "php/acciones/add/add_plantilla_preventiva.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        $(".datos_ajax_delete").show();
        $(".datos_ajax_delete").html(data);
        setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
        $('#confirm').modal('hide');
        load(1);
      }
    });
      
    event.preventDefault();
});

$( "#CopiarPlantilla" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#CopiarPlantilla')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      url: "php/acciones/update/update_copiar_plantilla.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        $(".datos_ajax_delete").show();
        $(".datos_ajax_delete").html(data);
        setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
        $('#copiar').modal('hide');
        load(1);
      }
    });
      
    event.preventDefault();
});