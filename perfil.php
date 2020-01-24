<?php 
    include('php/funciones.php');
?>

<?php
    $inactivo = 1800;
 
    if(isset($_SESSION['id_user']) ) {
        $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            header("location:index.php");
            exit;
        }
        else
        {
            $_SESSION['tiempo'] = time();
        }
    }
    else
    {
        header("location:index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include('nav.php');?>
    <div id="content">
        <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-12"><h3>Perfil</h3></div>
            <form class="pl-5 pt-3 pl-sm-0 e3 e4" id="Perfil">
                <div class="row flex-column-reverse flex-md-row">
                    <?php consulta_perfil_usuario($_SESSION['email']);?>
                </div>
                <div class="col-lg-12"><h3 class="pt-3 pb-3 e6">Opcional</h3></div>
                <div class="row e3 ">
                    <div class="col-sm-12 col-lg-4 e3">
                        <div class="col-lg-12 mt-2">
                            <label for="exampleInputEmail1">Contraseña Actual</label>
                            <input type="password" class="form-control" placeholder="*******" id="actual" name="actual">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 e3">
                        <div class="col-lg-12 mt-2">
                            <label for="exampleInputEmail1">Contraseña Nueva</label>
                            <input type="password" class="form-control" placeholder="*******" id="nueva" name="nueva"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 e3">
                        <div class="col-lg-12 mt-2">
                            <label for="exampleInputEmail1">Confirmar Contraseña</label>
                            <input type="password" class="form-control" placeholder="*******" id="confirmar" name="confirmar">
                        </div>
                    </div>
                </div>
                <div clasS="row mt-3">
                    <div class="col-lg-12 e11">
                        <input class="btn btn-primary pl-5 pr-5 mt-2 ml-3" type="submit" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include('footer.php');?>

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
        $( "#Perfil" ).submit(function( event ) {
            event.preventDefault();
            var form = $('#Perfil')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "ajax/update_perfil.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $(".datos_ajax_delete").show();
                    $(".datos_ajax_delete").html(data);
                    setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
                    if(data = "Los datos han sido actualizados satisfactoriamente.")
                    {
                        setTimeout(function() { location.href ="perfil.php"; }, 3000);
                    }
                    $('#actual').val('');
                    $('#nueva').val('');
                    $('#confirmar').val('');
                }
            });
                event.preventDefault();
        });
    </script>
</body>
</html>