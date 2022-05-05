
    $('#dataRegister').on('show.bs.modal', function (event) {
      $('#imagenmuestra1').attr("src", 'img/equipos/sn.png')
      $('#file-input').val('')
    })

    $('#dataUpdate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var id = button.data('id')
      var nombre = button.data('nombre') 
      var marca = button.data('marca') 
      var ubicacion = button.data('ubicacion') 
      var linea = button.data('linea')
      var caracteristicas = button.data('caracteristicas')
      var imagen = button.data('imagen')
      var img = button.data('img')
      var estado = button.data('estado')

      var modal = $(this)
      modal.find('.modal-title').text('Editar : '+nombre)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #nombre').val(nombre)
      modal.find('.modal-body #marca').val(marca)
      modal.find('select[id=ubicacion]').val(ubicacion)
      modal.find('select[id=linea]').val(linea)
      modal.find('.modal-body #caracteristicas').val(caracteristicas)
      
      if(imagen == null)
      {
        modal.find('.modal-body #img').attr("src", "img/equipos/sn.png")
      }
      
      else
      {
        modal.find('.modal-body #img').attr("src", imagen)
      }

      modal.find('.modal-body #img').val(img)
      modal.find('.modal-body #img-edit').val('')
      modal.find('.modal-body #estado').val(estado)
      $('.selectpicker').selectpicker('refresh');
      $('.alert').hide();
    })

    $('#Imagen').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var imagen = button.data('imagen')

      var modal = $(this)
      modal.find('.modal-body #imagen').attr("src", imagen)
  })
    
    $('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id') 
      var nombre = button.data('nombre')

      var modal = $(this)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #nombre').text(nombre)
    })

    $( "#actualidarDatos" ).submit(function( event ) {
      event.preventDefault();
      var form = $('#actualidarDatos')[0];
      var data = new FormData(form);

      $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "php/acciones/update/update_equipo.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
          $(".mensaje").show();
          $(".mensaje").html(data);
          setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
          $('#dataUpdate').modal('hide');
          $('#file-input').val('');
          $table.bootstrapTable('refresh');
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
        enctype: 'multipart/form-data',
        url: "php/acciones/add/add_equipo.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function (objeto) {
          $(".datos_ajax_register").html("Mensaje: Cargando...");
        },
        success: function (data) {
          $(".datos_ajax_delete").show();
          $(".datos_ajax_delete").html(data);
          setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
          $('#dataRegister').modal('hide');

          $('#nombre0').val('')
          $('#marca0').val('')
          $('#ubicacion0').val('')
          $('#caracteristicas0').val('')
          $('#imagenmuestra1').attr("src", '')

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
        url: "php/acciones/delete/delete_equipo.php",
        data: parametros,
        success: function(datos){
          $(".mensaje").show();
          $(".mensaje").html(datos);
          setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
          $('#dataDelete').modal('hide');
          $table.bootstrapTable('refresh');
          consulta_cuadros(1);
        }
      });
      event.preventDefault();
    });

    function consulta_cuadros(page) {
      var parametros = { "action": "ajax", "page": page };
      $.ajax({
          url: 'ajax/cuadros_equipos.php',
          data: parametros,
          dataType: "json",
          success: function (data) {
              $(".pro-stock").html(data[0]);
          }
      })
  }
  
