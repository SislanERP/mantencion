function load(page){
    var query=$("#q").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_gantt.php',
        data: parametros,
         beforeSend: function(){
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
        var inicio = button.data('inicio')
        var termino = button.data('termino')
        var año = button.data('año')

        var modal = $(this)
        modal.find('.modal-title').text('Editar : '+id)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #inicio').val(inicio)
        modal.find('.modal-body #termino').val(termino)
        modal.find('.modal-body #año').val(año)
        $('.alert').hide();
    })
  
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var anio = button.data('anio')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #anio').text(anio)
    })

    $('#dataDetalle').on('show.bs.modal', function (event) {
        $(".tab-1").addClass("d-none");
        $("#home-equipos").tab('show');
        var button = $(event.relatedTarget) 
        var id = button.data('id_gantt') 

        var modal = $(this)
        modal.find('.modal-body #id_gantt').val(id)

        listar_equipos($('#area').val());
        equipos_gantt(id);
    })

    $( "#guardarDatos" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#guardarDatos')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_gantt.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          beforeSend: function () {
            $(".datos_ajax_delete").html("Mensaje: Cargando...");
          },
          success: function (data) {
            $(".datos_ajax_delete").show();
            $(".datos_ajax_delete").html(data);
            setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
            $('#dataRegister').modal('hide');
            $('#año0').val('');


            load(1);
          }
        });
          
        event.preventDefault();
    });

    $( "#AddEquipo" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#AddEquipo')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_equipo_gantt.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function(data) {
            $(".mensaje_gantt_equipo").show();
            $(".mensaje_gantt_equipo").html(data);
            setTimeout(function() { $('.mensaje_gantt_equipo').fadeOut('fast'); }, 3000);

            var id = $("#id_gantt").val();
            equipos_gantt(id);

          }
        });
          
        event.preventDefault();
    });

    $( "#AddActividad" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#AddActividad')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_actividad_gantt.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function(data) {
            $(".mensaje_gantt_actividad").show();
            $(".mensaje_gantt_actividad").html(data);
            setTimeout(function() { $('.mensaje_gantt_actividad').fadeOut('fast'); }, 3000);

            var id = $("#id_gantt_equipo").val();
            actividades_gantt(id);
            $("#actividad").val('');

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
          url: "php/acciones/update/update_gantt.php",
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
                    url: "php/acciones/delete/delete_gantt.php",
                    data: parametros,
                     beforeSend: function(){
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

    function listar_equipos(id){
        var query=id;
        var parametros = {'query':query};
        $("#loader").fadeIn('slow');
        $.ajax({
            url:'ajax/listar_select_gantt.php',
            data: parametros,
            success:function(data){
                $("#select_equipos").html(data);  
            }
        })
    }

    function equipos_gantt(id){
        var parametros = {'query':id};
        $.ajax({
            url:'ajax/listar_equipos_gantt.php',
            data: parametros,
            success:function(data){
                $("#listado_equipos_gantt").html(data);  
            }
        })
    }

    function actividades_gantt(id){
        var parametros = {'query':id};
        $.ajax({
            url:'ajax/listar_gantt_actividades.php',
            data: parametros,
            success:function(data){
                $("#listado_actividades_gantt").html(data);  
            }
        })
    }

    $('#area').on('change', function() {
        listar_equipos(this.value);
    });

    $("#home-equipos").click(function(){
        $(".tab-1").addClass("d-none");
        $("#actividad").val('');
    });
