function load(page){
    var usuario=$("#usuario").val();
    var parametros = {"action":"ajax","page":page,'usuario':usuario};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_accesos.php',
        data: parametros,
         beforeSend: function(objeto){
        $("#loader").html("<img src='img/loader.gif'>");
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}

$( "#guardarDatos" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#guardarDatos')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      url: "php/acciones/add/add_acceso.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function (objeto) {
        $(".datos_ajax_delete").html("Mensaje: Cargando...");
      },
      success: function (data) {
        $(".datos_ajax_delete").show();
        $(".datos_ajax_delete").html(data);
        setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
        load(1);
      }
    });
      
    event.preventDefault();
});
