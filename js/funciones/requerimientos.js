function load(page){
    var query=$("#q").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_requerimientos.php',
        data: parametros,
         beforeSend: function(objeto){
        $("#loader").html("<img src='img/loader.gif'>");
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}

    $('#dataUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var actividad = button.data('actividad')
        var imagen = button.data('imagen')

        var modal = $(this)
        modal.find('.modal-title').text('Editar Requerimiento')
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #actividad').val(actividad)
        modal.find('.modal-body #img').attr("src", imagen)
        $('.alert').hide();
    })

    $('#dataResponder').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var actividad = button.data('actividad')
        var imagen = button.data('imagen')
        var area = button.data('area')
        var estado = button.data('estado')
        var terminado = button.data('terminado')
        var prioridad = button.data('prioridad')
        var responsable = button.data('responsable')
        var desarrollo = button.data('desarrollo')

        var modal = $(this)
        modal.find('.modal-title').text('Responder Requerimiento')
        modal.find('.modal-body #id1').val(id)
        modal.find('.modal-body #actividad1').val(actividad)
        modal.find('.modal-body #imagenmuestra1').attr("src", imagen)
        modal.find('select[id=prioridad1]').val(prioridad)
        modal.find('select[id=responsable1]').val(responsable)
        modal.find('.modal-body #desarrollo1').val(desarrollo)
        document.getElementById("img-href").href = imagen;
        document.getElementById("img-href").val = imagen;

        if(terminado == 1)
        {
            $("#blo").css("pointer-events", "none");
            modal.find('.modal-body #prioridad1').prop("disabled", true)
            modal.find('.modal-body #responsable1').prop("disabled", true)
            modal.find('.modal-body #desarrollo1').prop("readonly", true)
            modal.find('.modal-body #estado1').prop("disabled", true)
            $('#esta').hide()
        }
        else
        {
            if(area == 2)
            {
                $("#blo").css("pointer-events", "none");
                modal.find('.modal-body #prioridad1').prop("disabled", false)
                modal.find('.modal-body #responsable1').prop("disabled", false)
                modal.find('.modal-body #desarrollo1').prop("readonly", false)
                modal.find('.modal-body #estado1').prop("disabled", false)
            }

            else
            {
                modal.find('.modal-body #prioridad1').prop("disabled", true)
                modal.find('.modal-body #responsable1').prop("disabled", true)
                modal.find('.modal-body #desarrollo1').prop("readonly", true)
                modal.find('.modal-body #estado1').prop("disabled", true)
            }

            $('#esta').show()
        }

        if(terminado == 0)
        {
          modal.find('.modal-body #inlineCheckbox1').prop("checked", true);
        }
        else{
          modal.find('.modal-body #inlineCheckbox2').prop("checked", true);
        }

        modal.find('.modal-body #actividad1').prop("readonly", true)
        $("#im").css("pointer-events", "none");
        $('.selectpicker').selectpicker('refresh');
        $('.alert').hide();
    })
  
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id') 

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #id').text(id)
    })

    $( "#guardarDatos" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#guardarDatos')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_requerimiento.php",
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
            $('#actividad0').val('');

            load(1);
          }
        });
          
        event.preventDefault();
    });


    $( "#Responder" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#Responder')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/update/update_requerimientos_respuesta.php",
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
            $('#dataResponder').modal('hide');

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
          url: "php/acciones/update/update_requerimiento.php",
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
                    url: "php/acciones/delete/delete_requerimiento.php",
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