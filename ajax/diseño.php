<?php
    session_start();
	require_once("../php/conexion.php");
    $arr = array();
    $email = $_SESSION['email'];

    $arr[0] = "";
    $consulta = "call consulta_menu_perfil()";
    $resultado = mysqli_query(conectar(), $consulta );
    while ($columna = mysqli_fetch_array( $resultado ))
    {
        if($columna['id_menu'] == 5)
        {
            $arr[0] = $arr[0] ."
                        <a href='' class='dropdown-item' data-toggle='modal' data-target='#".$columna['href']."'>
                            <i class='".$columna['icono']."'></i>
                            <span>".$columna['menu']."</span>
                        </a>
            ";
        }
        else{
            $arr[0] = $arr[0] ."
                        <a href='".$columna['href']."' class='dropdown-item'>
                            <i class='".$columna['icono']."'></i>
                            <span>".$columna['menu']."</span>
                        </a>
            ";
        }
    }

    $arr[1] = "";
    $query="select distinct a.id_area as Id, c.area as Area from menu a inner join accesos b on a.id_menu = b.id_menu inner JOIN areas c on a.id_area = c.id_area and b.id_usuario_acceso = $_SESSION[id_user] and b.acceso = 1";
    $resultado = mysqli_query(conectar(), $query );
    while ($columna = mysqli_fetch_array( $resultado ))
    {
            $arr[1] .= " <hr class='my-3'>
                        <h6 class='navbar-heading text-muted'>".$columna['Area']."</h6>
                        <ul class='navbar-nav'>";

            $query1="select a.*, c.color as color from menu a inner join accesos b on a.id_menu = b.id_menu inner JOIN areas c on a.id_area = c.id_area and b.id_usuario_acceso = $_SESSION[id_user] and b.acceso = 1 and a.id_area = $columna[Id]";
            $resultado1 =  mysqli_query(conectar(), $query1 );
            while ($columna1 = mysqli_fetch_array( $resultado1 ))
            {
                $arr[1] .= "
                        <li class='nav-item'>
                            <a class='nav-link' href='".$columna1['href']."'>
                                <i class='".$columna1['icono']."' style='color:".$columna1['color']."'></i>
                                <span>".$columna1['menu']."</span>
                            </a>
                        </li>";
            }
            $arr[1] .= "</ul>";    
    }
        

    $arr[2] = "";
    $consulta = "call consulta_login('$email')";
    $resultado = mysqli_query(conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        $arr[2] = "
                    <span class='avatar avatar-sm rounded-circle'>
                        <img src='".$columna['imagen']."'>
                    </span>
                    <div class='media-body ml-2 d-none d-lg-block'>
                        <span class='mb-0 text-sm  font-weight-bold'>".$columna['nombre']."</span>
                    </div>
        ";
    }

    echo json_encode($arr);
?>

		