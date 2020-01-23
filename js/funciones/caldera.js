function load(page){
    var query=$("#fecha").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_caldera.php',
        data: parametros,
         beforeSend: function(objeto){
        $("#loader").html("<img src='img/loader.gif'>");
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
            consulta_cuadros(1);
        }
    })
}

    $('#dataUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var fecha = button.data('fecha')
        var turno = button.data('turno')
        var tipo = button.data('tipo')
        var entrada = button.data('entrada')
        var salida = button.data('salida')

        var modal = $(this)
        modal.find('.modal-title').text('Editar Consumo')
        modal.find('.modal-body #id').val(id)
        modal.find('select[id=turno]').val(turno)
        modal.find('select[id=tipo]').val(tipo)
        modal.find('.modal-body #entrada').val(entrada)
        modal.find('.modal-body #salida').val(salida)
        $('.selectpicker').selectpicker('refresh');
        $('.alert').hide();
    })
  
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var tipo = button.data('tipo')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #tipo').text(tipo)
    })

    $( "#guardarEncabezado" ).submit(function( event ) {
      event.preventDefault();
      var form = $('#guardarEncabezado')[0];
      var data = new FormData(form);

      $.ajax({
        type: "POST",
        url: "php/acciones/add/add_caldera.php",
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

    $( "#guardarDatos" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#guardarDatos')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_caldera_detalle.php",
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
            $('#dataRegister').modal('hide');
            $('#entrada0').val('');
            $('#salida0').val('');

            load(1);
          }
        });
          
        event.preventDefault();
    });

    $( "#actualidarDatos" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#actualidarDatos')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/update/update_caldera_detalle.php",
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
            $('#dataUpdate').modal('hide');
  
            load(1);
          }
        });
          event.preventDefault();
      });

    $( "#eliminarDatos" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "php/acciones/delete/delete_caldera_detalle.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        $(".datos_ajax_delete").html("Mensaje: Cargando...");
                      },
                    success: function(datos){
                      $(".datos_ajax_delete").show();
                      $(".datos_ajax_delete").html(datos);
                      setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
                      $('#dataDelete').modal('hide');
                      load(1);
                  }
            });
          event.preventDefault();
        });

        function consulta_cuadros(page) {
          var fecha=$("#fecha").val();
          var parametros = { "action": "ajax", "page": page,'fecha':fecha };
          $.ajax({
              url: 'ajax/consulta_caldera.php',
              data: parametros,
              dataType: "json",
              success: function (data) {
                  if($('#save').prop('disabled') )
                  {
                    $("#agregar_control").bind('click', false);
                  }
                  else{
                    $("#agregar_control").unbind('click', false);
                  }
                  $("#hora_encendido").val(data[0]);
                  $("#hora_apagado").val(data[1]);
                  $("#observacion").val(data[2]);
              },
              error: function() {
                  $("#agregar_control").bind('click', false);
                  $("#hora_encendido").val('');
                  $("#hora_apagado").val('');
                  $("#observacion").val('');
              }
          })
      }     