function load(page){
    var query=$("#q").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_equipos.php',
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
    $('#dataRegister').on('show.bs.modal', function (event) {
      $('#imagenmuestra1').attr("src", '')
      $('#file-input').val('')
    })

    $('#dataUpdate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var nombre = button.data('nombre') // Extraer la información de atributos de datos
      var marca = button.data('marca') // Extraer la información de atributos de datos
      var ubicacion = button.data('ubicacion') // Extraer la información de atributos de datos
      var linea = button.data('linea')
      var caracteristicas = button.data('caracteristicas') // Extraer la información de atributos de datos
      var imagen = button.data('imagen')
      var img = button.data('img')

      var modal = $(this)
      modal.find('.modal-title').text('Editar : '+nombre)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #nombre').val(nombre)
      modal.find('.modal-body #marca').val(marca)
      modal.find('select[id=ubicacion]').val(ubicacion)
      modal.find('select[id=linea]').val(linea)
      modal.find('.modal-body #caracteristicas').val(caracteristicas)
      modal.find('.modal-body #img').attr("src", imagen)
      modal.find('.modal-body #img').val(img)
      modal.find('.modal-body #img-edit').val('')
      $('.selectpicker').selectpicker('refresh');
      $('.alert').hide();//Oculto alert
    })

    $('#Imagen').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var imagen = button.data('imagen')

      var modal = $(this)
      modal.find('.modal-body #imagen').attr("src", imagen)
  })
    
    $('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var nombre = button.data('nombre') // Extraer la información de atributos de datos

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
        beforeSend: function (objeto) {
          $(".datos_ajax").html("Mensaje: Cargando...");
        },
        success: function (data) {
          $(".datos_ajax_delete").show();
          $(".datos_ajax_delete").html(data);
          setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
          $('#dataUpdate').modal('hide');
          $('#file-input').val('');
          load();
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

          load();
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
                 beforeSend: function(objeto){
                    $(".datos_ajax_delete").html("Mensaje: Cargando...");
                  },
                success: function(datos){
                  $(".datos_ajax_delete").show();
                  $(".datos_ajax_delete").html(datos);
                  setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
                  $('#dataDelete').modal('hide');
                  load();
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
  
