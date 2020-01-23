function load(page){
    var fecha=$("#fecha").val();
    var parametros = {"action":"ajax","page":page,'fecha':fecha};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_sala_maquinas.php',
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
        var equipo = button.data('equipo')
        var temperatura = button.data('temperatura')
        var inicio = button.data('inicio')
        var termino = button.data('termino')

        var modal = $(this)
        modal.find('.modal-title').text('Editar Detención')
        modal.find('.modal-body #id').val(id)
        modal.find('select[id=equipo]').val(equipo)
        modal.find('.modal-body #temperatura').val(temperatura)
        modal.find('.modal-body #inicio').val(inicio)
        modal.find('.modal-body #termino').val(termino)
        $('.selectpicker').selectpicker('refresh');
        $('.alert').hide();
    })
  
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var equipo = button.data('equipo')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #maquina').text(equipo)
    })

    $( "#guardarEncabezado" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#guardarEncabezado')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_sala_maquinas.php",
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
            consulta_cuadros(1);
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
          url: "php/acciones/add/add_sala_maquinas_detalle.php",
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
            $('#temperatura0').val('');
            $('#inicio0').val('');
            $('#termino0').val('');

            load(1);
            consulta_cuadros(1);
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
          url: "php/acciones/update/update_sala_maquinas_detalle.php",
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
            consulta_cuadros(1);
          }
        });
          event.preventDefault();
      });

    $( "#eliminarDatos" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "php/acciones/delete/delete_sala_maquinas_detalle.php",
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
                      consulta_cuadros(1);
                  }
            });
          event.preventDefault();
        });
    
    function consulta_cuadros(page) {
        var fecha=$("#fecha").val();
        var parametros = { "action": "ajax", "page": page,'fecha':fecha };
        $.ajax({
            url: 'ajax/consulta_sala_maquinas.php',
            data: parametros,
            dataType: "json",
            success: function (data) {
                if($('#save').prop('disabled') )
                {
                  $("#agregar_detencion").bind('click', false);
                }
                else{
                  $("#agregar_detencion").unbind('click', false);
                }
                $("#observacion").val(data[0]);
            },
            error: function() {
                $("#agregar_detencion").bind('click', false);
                $("#observacion").val('');
            }
        })
    }