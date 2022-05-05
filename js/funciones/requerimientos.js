    $('#dataRegister').on('show.bs.modal', function (event) {
        $('#imagenmuestra1').attr("src", 'img/equipos/sn.png')
        $('#file-input').val('')
    })

    $('#dataUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var actividad = button.data('actividad')
        var imagen = button.data('imagen')

        var modal = $(this)
        modal.find('.modal-title').text('Editar Requerimiento')
        modal.find('.modal-body #id-edit').val(id)
        modal.find('.modal-body #actividad').val(actividad)
        modal.find('.modal-body #img').attr("src", imagen)
        modal.find('.modal-body #img-href-edit').val(id)
        document.getElementById('img-href-edit').href = imagen;
        $('.alert').hide();
    })

    $('#dataResponder').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var actividad = button.data('actividad')
        var imagen = button.data('imagen')
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
        modal.find('select[id=estado1]').val(estado)
        modal.find('select[id=responsable1]').val(responsable)
        modal.find('.modal-body #desarrollo1').val(desarrollo)
        modal.find('.modal-body #img-href').val(id)
        document.getElementById('img-href').href = imagen;

        if(terminado == "SI")
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
            $.ajax({
                url:'ajax/consulta_area_usuario.php',
                success:function(data){
                    if(data == 2)
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
                }
            })

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
        modal.find('.modal-body #id-delete').val(id)
        modal.find('.modal-body #id-delete').text(id)
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
            $(".mensaje").html("Mensaje: Cargando...");
          },
          success: function (data) {
            $(".mensaje").show();
            $(".mensaje").html(data);
            //setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
            $('#dataRegister').modal('hide');
            $('#actividad0').val('');
            $table.bootstrapTable('refresh');
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
            $(".mensaje").html("Mensaje: Cargando...");
          },
          success: function (data) {
            $(".mensaje").show();
            $(".mensaje").html(data);
            setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
            $('#dataResponder').modal('hide');
            $table.bootstrapTable('refresh');
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
            $(".mensaje").html("Mensaje: Cargando...");
          },
          success: function (data) {
            $(".mensaje").show();
            $(".mensaje").html(data);
            setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
            $('#dataUpdate').modal('hide');
            $table.bootstrapTable('refresh');
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
                        $(".mensaje").html("Mensaje: Cargando...");
                      },
                    success: function(datos){
                      $(".mensaje").show();
                      $(".mensaje").html(datos);
                      setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
                      $('#dataDelete').modal('hide');
                      $table.bootstrapTable('refresh');
                  }
            });
          event.preventDefault();
        });