function load(page){
    var fecha=$("#fecha").val();
    var parametros = {"action":"ajax","page":page,'fecha':fecha};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_detenciones.php',
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
        var tipo_falla = button.data('tipo_falla')
        var equipo = button.data('equipo')
        var descripcion = button.data('descripcion')
        var falla = button.data('falla')
        var tiempo = button.data('tiempo')
        var detencion = button.data('detencion')

        var modal = $(this)
        modal.find('.modal-title').text('Editar Detención')
        modal.find('.modal-body #id').val(id)
        modal.find('select[id=tipo]').val(tipo_falla)
        modal.find('select[id=equipo]').val(equipo)
        modal.find('.modal-body #descripcion').val(descripcion)
        modal.find('.modal-body #falla').val(falla)
        modal.find('.modal-body #tiempo').val(tiempo)
        $('.selectpicker').selectpicker('refresh');
        if(detencion == 0)
        {
          modal.find('.modal-body #detencion_proceso4').prop("checked", true);
        }
        else{
          modal.find('.modal-body #detencion_proceso3').prop("checked", true);
        }
        $('.alert').hide();
    })
  
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var tipo_falla = button.data('tipo_falla')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #tipo').text(tipo_falla)
    })

    $( "#guardarEncabezado" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#guardarEncabezado')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_detencion.php",
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
          url: "php/acciones/add/add_detencion_detalle.php",
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
            $('#descripcion0').val('');
            $('#falla0').val('');
            $('#tiempo0').val('');

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
          url: "php/acciones/update/update_detencion_detalle.php",
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
                    url: "php/acciones/delete/delete_detencion_detalle.php",
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
            url: 'ajax/consulta_detencion.php',
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
                $("#camiones").val(data[0]);
                $("#kilos_mm_pp").val(data[1]);
                $("#kilos_producidos").val(data[2]);
                $("#rendimiento").val(data[3]);
                $("#kilos_embolsado").val(data[4]);
            },
            error: function() {
                $("#agregar_detencion").bind('click', false);
                $("#camiones").val('');
                $("#kilos_mm_pp").val('');
                $("#kilos_producidos").val('');
                $("#rendimiento").val('');
                $("#kilos_embolsado").val('');
            }
        })
    }