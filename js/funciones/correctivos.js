    $('#dataUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var fecha = button.data('fecha')
        var prioridad = button.data('prioridad')
        var equipo = button.data('equipo')
        var actividad = button.data('actividad')
        var responsable = button.data('responsable')
        var estado = button.data('estado')
        var ot = button.data('ot')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #fecha').val(fecha)
        modal.find('.modal-body #ot_padre').val(ot)
        modal.find('select[id=prioridad]').val(prioridad)
        modal.find('select[id=equipo]').val(equipo)
        modal.find('.modal-body #actividad').val(actividad)
        modal.find('select[id=responsable]').val(responsable)
        modal.find('select[id=estado]').val(estado)
        $('.selectpicker').selectpicker('refresh');
        $('.alert').hide();
    })
  
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var fecha = button.data('fecha')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #fec').text(fecha)
    })

    $( "#guardarDatos" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#guardarDatos')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_correctivo.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function (data) {
            $(".mensaje").show();
            $(".mensaje").html(data);
            setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
            $('#dataRegister').modal('hide');
            $('#actividad0').val('');
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
            url: "php/acciones/update/update_correctivo.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
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
                    url: "php/acciones/delete/delete_correctivo.php",
                    data: parametros,
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