<?php
    session_start();
    include("php/conexion.php");
    $_SESSION['titulo'] = "Perfil";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Sistema Mantención | <?=$_SESSION['titulo']?></title>
  <?php include('head.php')?>
</head>

<body>
  
    <?php include("menu.php");?>

    <div class="main-content">
        <?php include("nav.php");?>

        <div class="header pb-8 d-flex align-items-center" style="min-height: 500px; background-image: url('img/banner/fondo_one.jpg'); background-size: cover; background-position: top;margin-top: -150px;">
            <span class="mask bg-gradient-default opacity-6"></span>
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 id="name" class="display-2 text-white"></h1>
                    </div>
                </div>
            </div>
        </div>
        <form id="Perfil">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                        <div class="card card-profile shadow">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 order-lg-2">
                                    <div class="card-profile-image">
                                        <div class='col-lg-12 d-flex justify-content-center mb-3'>
                                            <img id="imagenmuestra1" src="" class="rounded-circle" style='object-fit:cover;height:175px;'>
                                            <div class='image-upload'>
                                                <label for='file-input'>
                                                    <i class="img-perfil ni ni-camera-compact"></i>
                                                </label>

                                                <input type='file' name='imagen' id='file-input'/>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-1">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 id="name1">
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2" id="correo"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1 pb-4">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Mi cuenta</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">Información</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Nombre</label>
                                        <input type="text" id="nombre" name="nombre" class="form-control form-control-alternative" placeholder="Nombre">
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-alternative" placeholder="email@ejemplo.com" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Dirección</label>
                                        <input type="text" id="direccion" name="direccion" class="form-control form-control-alternative" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Teléfono</label>
                                        <div class='input-group'>
                                            <div class='input-group-prepend'>
                                                <div class='input-group-text'>+56 9</div>
                                            </div>    
                                            <input type='text' class='form-control' placeholder='Teléfono' name='telefono' id="telefono" minlength='8' maxlength='8' pattern='[0-9]{8}'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />

                        <h6 class="heading-small text-muted mb-4">Seguridad</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">Contraseña actual</label>
                                        <input id="actual" name="actual" class="form-control form-control-alternative" placeholder="•••••" type="password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Contraseña nueva</label>
                                        <input id="nueva" name="nueva" class="form-control form-control-alternative" placeholder="•••••" type="password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Confirmar contraseña</label>
                                        <input id="confirmar" name="confirmar" class="form-control form-control-alternative" placeholder="•••••" type="password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                        
                        <hr class="my-4" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="mensaje"></div>
    
    <?php include("script.php");?>

    <script>
        $(document).ready(function(){
            load();
        });
    </script>

    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagenmuestra1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
        }
            $("#file-input").change(function() {
            readURL(this);
        });
    </script>

    <script>
        function load() {
            $.ajax({
                url: 'ajax/consulta_perfil.php',
                dataType: "json",
                success: function (data) {
                    $("#nombre").val(data[0]);
                    $("#email").val(data[1]);
                    $("#direccion").val(data[2]);
                    $("#telefono").val(data[3]);
                    $('#imagenmuestra1').attr('src', data[4]);
                    $("#id").val(data[5]);
                    $("#correo").text(data[1]);
                    $("#name").text('Hola '+data[0]);
                    $("#name1").text(data[0]);
                    diseño();
                }
            })
        }
    </script>

    <script>
        $( "#Perfil" ).submit(function( event ) {
            event.preventDefault();
            var form = $('#Perfil')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "php/acciones/update/update_perfil.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $(".mensaje").show();
                    $(".mensaje").html(data);
                    setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 3000);
                    $('#actual').val('');
                    $('#nueva').val('');
                    $('#confirmar').val('');
                    
                    load();
                }
            });
                event.preventDefault();
        });
    </script>
</body>

</html>