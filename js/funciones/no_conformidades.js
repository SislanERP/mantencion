function load(page){
    var query=$("#q").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_no_conformidades.php',
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
        var fecha = button.data('fecha')
        var area = button.data('area')
        var producto = button.data('producto')
        var fase = button.data('fase')
        var personal = button.data('personal')
        var desviacion = button.data('desviacion')
        var img_antes = button.data('img_antes')

        var modal = $(this)
        modal.find('.modal-title').text('Editar Desviación')
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #fecha').val(fecha)
        modal.find('select[id=area]').val(area)
        modal.find('select[id=producto]').val(producto)
        modal.find('select[id=fase]').val(fase)
        modal.find('select[id=detector]').val(personal)
        modal.find('.modal-body #desviacion').val(desviacion)
        modal.find('.modal-body #img').attr("src", img_antes)
        $('.selectpicker').selectpicker('refresh');
        $('.alert').hide();
    })

    $('#dataResponder').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var desviacion = button.data('desviacion')
        var causa = button.data('causa')
        var correctivo = button.data('correctivo')
        var preventivo = button.data('preventivo')
        var responsable = button.data('responsable')
        var observaciones = button.data('observaciones')
        var estado = button.data('estado')
        var ejecucion = button.data('ejecucion')
        var area = button.data('area')
        var fec_ejecucion= button.data('fec_ejecucion')
        var depa= button.data('depa')
        var img_antes = button.data('img_antes')
        var img_despues = button.data('img_despues')


        var modal = $(this)
        modal.find('.modal-title').text('Responder No Conformidad')
        modal.find('.modal-body #id1').val(id)
        modal.find('.modal-body #desviacion1').val(desviacion)
        modal.find('.modal-body #causa1').val(causa)
        modal.find('.modal-body #correctivo1').val(correctivo)
        modal.find('.modal-body #preventivo1').val(preventivo)
        modal.find('.modal-body #responsable1').val(responsable)
        modal.find('.modal-body #observaciones1').val(observaciones)
        modal.find('.modal-body #ejecucion1').val(fec_ejecucion)
        modal.find('.modal-body #area').val(area)
        modal.find('.modal-body #depa').val(depa)
        modal.find('.modal-body #img').attr("src", img_antes)
        modal.find('.modal-body #img1').attr("src", img_despues)

        if(estado == 2)
        {
          if(area == 3)
          {
            modal.find('.modal-body #correctivo1').prop("readonly", true)
            modal.find('.modal-body #causa1').prop("readonly", true)
            modal.find('.modal-body #preventivo1').prop("readonly", true)
            modal.find('.modal-body #responsable1').prop("readonly", true)
            modal.find('.modal-body #observaciones1').prop("readonly", true)
            modal.find('.modal-body #ejecucion1').prop("readonly", true)
            $("#blo").css("pointer-events", "none");
            $("#im1").css("pointer-events", "none");
            $("#im2").css("pointer-events", "none");
            modal.find('.modal-body #estado').prop("disabled", true)
            $('#esta').show()
          }
          else
          {
            modal.find('.modal-body #correctivo1').prop("readonly", true)
            modal.find('.modal-body #causa1').prop("readonly", true)
            modal.find('.modal-body #preventivo1').prop("readonly", true)
            modal.find('.modal-body #responsable1').prop("readonly", true)
            modal.find('.modal-body #observaciones1').prop("readonly", true)
            modal.find('.modal-body #ejecucion1').prop("readonly", true)
            modal.find('.modal-body #inlineCheckbox1').prop("disabled", true)
            modal.find('.modal-body #inlineCheckbox2').prop("disabled", true)
            modal.find('.modal-body #estado').prop("disabled", true)
            $("#im1").css("pointer-events", "none");
            $("#im2").css("pointer-events", "none");
            $('#esta').hide()
          }

          $('#bot').hide()
        }
        else{

          if(area == 3)
          {
              modal.find('.modal-body #correctivo1').prop("readonly", true)
              modal.find('.modal-body #causa1').prop("readonly", true)
              modal.find('.modal-body #preventivo1').prop("readonly", true)
              modal.find('.modal-body #responsable1').prop("readonly", true)
              modal.find('.modal-body #observaciones1').prop("readonly", false)
              modal.find('.modal-body #ejecucion1').prop("readonly", true)
              $("#blo").css("pointer-events", "none");
              $("#im1").css("pointer-events", "none");
              modal.find('.modal-body #estado').prop("disabled", false)
              $('#esta').show()
          }
          else
          {
              modal.find('.modal-body #correctivo1').prop("readonly", false)
              modal.find('.modal-body #causa1').prop("readonly", false)
              modal.find('.modal-body #preventivo1').prop("readonly", false)
              modal.find('.modal-body #responsable1').prop("readonly", false)
              modal.find('.modal-body #observaciones1').prop("readonly", true)
              modal.find('.modal-body #ejecucion1').prop("readonly", false)
              modal.find('.modal-body #inlineCheckbox1').prop("disabled", false)
              modal.find('.modal-body #inlineCheckbox2').prop("disabled", false)
              $("#im1").css("pointer-events", "none");
              $("#im2").css("pointer-events", "none");
              $('#esta').hide()
          }

          $('#bot').show()
        }
        
        if(ejecucion == 0)
        {
          modal.find('.modal-body #inlineCheckbox1').prop("checked", true);
        }
        else{
          modal.find('.modal-body #inlineCheckbox2').prop("checked", true);
        }
        
        modal.find('select[id=estado]').val(estado)
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
          url: "php/acciones/add/add_no_conformidad.php",
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
            $('#desviacion0').val('');

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
          url: "php/acciones/update/update_no_conformidad_respuesta.php",
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
          url: "php/acciones/update/update_no_conformidad.php",
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
                    url: "php/acciones/delete/delete_no_conformidad.php",
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