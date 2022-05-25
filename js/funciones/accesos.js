function load(page){
    var usuario=$("#usuario").val();
    var parametros = {"action":"ajax","page":page,'usuario':usuario};
    $.ajax({
        url:'ajax/listar_accesos.php',
        data: parametros,
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
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
      success: function (data) {
        $(".mensaje").show();
        $(".mensaje").html(data);
        setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
        load(1);
      }
    });
      
    event.preventDefault();
});
