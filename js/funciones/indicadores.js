
    $( "#Paras" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#Paras')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "ajax/consulta_paras.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function (data) {
            $(".datos_ajax_delete").show();
            $(".datos_ajax_delete").html(data);
          }
        });
          
        event.preventDefault();
    });

    