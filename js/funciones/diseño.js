function diseño() {
    $.ajax({
        url: 'ajax/diseño.php',
        dataType: "json",
        success: function (data) {
            $("#menu_perfil").html(data[0]);
            $("#menu_perfil_movil").html(data[0]);
            $("#menu").html(data[1]);
            $("#media").html(data[2]);
        }
    })
}