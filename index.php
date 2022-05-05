<!DOCTYPE html>
<html lang="es">
<head>
  <title></title>
  <?php include('head.php')?>
</head>

<body class="bg-default">
  <div class="main-content">
    
    <!-- Header -->
    <div class="header fondo_one py-7 py-lg-10">
      <div class="container d-flex justify-content-center">
        <img class="w-25" src="img/brand/logo.png" alt="" />
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--10">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Ingresa con tus credenciales</small>
              </div>
              <form id="Inicio">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control pl-3" placeholder="Email" type="email" id="email" name="email" autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control pl-3" placeholder="Password" type="password" id="pass" name="pass">
                  </div>
                </div>
                <div>
                  <button type="submit" class="btn btn-default my-4 w-100">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small>Olvide mi contraseña?</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              © <?php echo date('Y')?> <a href="#" class="font-weight-bold ml-1 text-light" target="_blank">Creado por Landes</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <div class="resultado position-absolute w-100 d-flex justify-content-center"></div>
  <?php include('script.php')?>
  <script>
        $("#Inicio").submit(function (event) {
        {
            event.preventDefault();
            var form = $('#Inicio')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "ajax/login.php",
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
                        $(".resultado").html(data);
                          setTimeout(function() { $('.resultado').fadeOut('fast'); }, 5000);
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