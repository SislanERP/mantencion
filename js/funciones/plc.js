function load(page){
    var usuario=$("#usuario").val();
    var parametros = {"action":"ajax","page":page,'usuario':usuario};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/consulta_plc.php',
        data: parametros,
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}

