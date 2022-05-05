
    $( "#Paras" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#Paras')[0];
        var data = new FormData(form);

        $.ajax({
          type: "POST",
          url: "ajax/consulta_paras_ubicaciones.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function (data) {
            $("#chartdiv").show();
            $("#chartdiv").html(data);
          }
        });
          
        event.preventDefault();
    });

    