
    $( "#Paras" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#Paras')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "ajax/consulta_paras_equipos.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function (data) {
            $(".resultado_equipos").show();
            $(".resultado_equipos").html(data);
          }
        });

        $.ajax({
          type: "POST",
          url: "ajax/consulta_paras_ubicaciones.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function (data) {
            $(".resultado_ubicacion").show();
            $(".resultado_ubicacion").html(data);
          }
        });
          
        event.preventDefault();
    });

    