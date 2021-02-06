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
            echo "<script>location.href='index.php';</script>";
            die();
        }
        else
        {
            $_SESSION['tiempo'] = time();
        }
    }
    else
    {
        echo "<script>location.href='index.php';</script>";
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include('nav.php');?>

    <div id="content">
        <div class="content-fluid p-5 shadow mb-5 bg-white" style="background:#fff;border-radius:15px;">
            <h3>PLC</h3>
            
            <div class='w-100 d-flex outer_div mt-5'>
                <div class="resultado w-100"></div>
            </div> 
        </div>
    </div>
              
  <?php include('footer.php');?>

  <script>
      $(document).ready(function(){
        setInterval('load()',5000);
      });
    </script>
    <script>
        function load(){
            $.ajax({
                url: 'ajax/consulta_flujometro.php',
                success: function (data) {
                    $(".resultado").html(data);
                }
            })
        }
    </script>
</body>
</html>