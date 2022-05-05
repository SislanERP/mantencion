$( "#CrearPreventivo" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#CrearPreventivo')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      url: "php/acciones/update/update_evento_title.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function (objeto) {
        $(".mensaje").html("Mensaje: Cargando...");
      },
      success: function (data) {
        $(".mensaje").show();
        $(".mensaje").html(data);
        setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
        $('#ModalEdit').modal('hide');
        location.href="http://mantencion.landes.cl/calendario.php";
        //location.href="calendario.php";
      }
    });
      
    event.preventDefault();
});

  $( "#CrearEvento" ).submit(function( event ) {
      event.preventDefault();
      var form = $('#CrearEvento')[0];
      var data = new FormData(form);

      $.ajax({
        type: "POST",
        url: "php/acciones/add/add_evento.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function (objeto) {
          $(".mensaje").html("Mensaje: Cargando...");
        },
        success: function (data) {
          $(".mensaje").show();
          $(".mensaje").html(data);
          //setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
          $('#ModalAdd').modal('hide');
          //location.href="http://mantencion.landes.cl/calendario.php";
          location.href="calendario.php";
        }
      });
        
      event.preventDefault();
  });

  $( "#EliminarEvento" ).submit(function( event ) {
      event.preventDefault();
      var form = $('#EliminarEvento')[0];
      var data = new FormData(form);

      $.ajax({
        type: "POST",
        url: "php/acciones/delete/delete_evento.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function (objeto) {
          $(".mensaje").html("Mensaje: Cargando...");
        },
        success: function (data) {
          setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
          $('#ModalEdit').modal('hide');
          location.href="http://mantencion.landes.cl/calendario.php";
          //location.href="calendario.php";
        }
      });
        
      event.preventDefault();
  });

  