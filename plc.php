<?php 
  session_start();
  require_once("./php/conexion.php");
  $_SESSION['titulo'] = "PLC";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Sistema Mantención | <?=$_SESSION['titulo']?></title>
  <?php include('head.php')?>
</head>

<body>
    <?php include('menu.php')?>
    <div class="main-content">
        <?php include('nav.php')?>
        <!-- Header -->
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
        <div class="container-fluid mt--7 mb-5">
            <div class="row resultado bg-b shadow pr-3 pl-3">
            </div>
        </div>
    </div>
    <div class="mensaje"></div>
    <?php include('script.php')?>
    <script src="js/funciones/equipos.js"></script>
    <script>
        $(document).ready(function(){
            diseño();
            load();
            setInterval('load()',300000);
        });

        function load(){
            $.ajax({
                url: 'ajax/consulta_plc.php',
                success: function (data) {
                    $(".resultado").html(data);
                }
            })
        }
    </script>
    
</body>
</html>