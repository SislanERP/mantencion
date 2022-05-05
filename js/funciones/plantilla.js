function load() {
    var equipo=$("#equipo").val();
    var parametros = {'equipo':equipo };
    $.ajax({
        url: 'ajax/consulta_plantilla_equipo.php',
        data: parametros,
        dataType: "json",
        success: function (data) {
            $('#summernote').summernote();
            $('#summernote').summernote('code', data[0]);
            $('.note-btn').removeAttr('title');
        },
        error: function() {
            $('#summernote').summernote();
            $('#summernote').summernote('code', '');
            $('.note-btn').removeAttr('title');
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
        $(".mensaje").show();
        $(".mensaje").html(data);
        setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
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
        $(".mensaje").show();
        $(".mensaje").html(data);
        setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
        $('#copiar').modal('hide');
        load(1);
      }
    });
      
    event.preventDefault();
});