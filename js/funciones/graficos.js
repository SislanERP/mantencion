function anual(page){
    var query=2020;
    var parametros = {"action":"ajax","page":page,'query':query};
    $.ajax({
        url:'ajax/consulta_grafico_anual.php',
        data: parametros,
        success:function(data){
            $(".grafico").html(data);
        }
    })
}