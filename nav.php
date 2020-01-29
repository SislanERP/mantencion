<nav class="container-fluid nav-superior bg-white e2">
  <div class="row d-flex justify-content-between align-items-center">
    <div class="d-flex w-75">
      <a class="menu_desplegable" href="#" onclick="abrir()" ><img src="img/iconos/menu.png" alt="" style="width:40px;height:40px;margin-left:10px;"></a>
      <img class="logo img-fluid" src="img/logo.png" alt="">
    </div>
      <div class="perfil">
        <?php consulta_usuario();?>
      </div>
  </div>
</nav>
<div class="wrapper pt-3 pl-3 pr-3">
  <nav id="sidebar" class="shadow mb-5 bg-white">
    <ul class="list-unstyled components mt-4">
      <?php  consulta_menu();?>
    </ul>
    <?php consulta_menu_inferior();?>
  </nav>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Seleccione <b>"Cerrar sesión"</b> si está listo para finalizar su sesión actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="index.php">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function abrir()
    {
       $('#sidebar').toggleClass("active");
    }
  </script>