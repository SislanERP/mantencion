<?php 
    include('php/funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <div class="container-fluid vh-100">
        <div class="row vh-100">
        <div class="datos_ajax_delete mensaje"></div>
            <div class="col-sm-12 col-12 col-md-6 col-xl">
                <div class="d-flex justify-content-center align-items-center vh-100">
                    <img class="img-fluid w-50 mr-5 pr-5 icono" src="img/logo.png" alt="" style="z-index: 1;">
                    <img class="img-principal img-fluid vh-100" src="img/inicio.jpg" alt="">
                </div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-xl d-flex align-items-center">
                <form class="w-75" id="InicioSession">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email_login" placeholder="Ingresar e-mail" id="email" required autofocus>
                        <label for="inputPassword5">Contraseña</label>
                        <input type="password" name="password_login" class="form-control" placeholder="*******" id="pass" required>
                        <small><a href="">Restablecer contraseña</a>
                    </div>
                    <button type="submit" id="login" class="btn btn-primary">Iniciar sesion</button>
                </form>
                
            </div>
            
        </div>
    </div>

    <?php include('footer.php')?>
    <script>
        $("#InicioSession").submit(function (event) {
        {
            event.preventDefault();
            var form = $('#InicioSession')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "http://mantencion.landes.cl/ajax/login.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data=='1'){
                        location.href ="equipos.php";
                    }
                    else if(data=='2')
                    {
                        location.href ="perfil.php";
                    }
                    else {
                        $(".datos_ajax_delete").show();
                        $(".datos_ajax_delete").html(data);
                        setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 5000);
                        $('#pass').val('');
                    }
                }
            });
            event.preventDefault();
        }
        });
    </script>
</body>
</html>