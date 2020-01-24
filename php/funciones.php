<?php
    session_start();
    include ('php/conexion.php');
    
    function consulta_usuario()
    {
        $buscarUsuario = "call consulta_login('$_SESSION[email]')";
        $result = conectar()->query($buscarUsuario);
        if ($columna = mysqli_fetch_array( $result ))
		{
            echo    "<p class='hi'>Hola,<span><b class='text-dark'> ".$columna['nombre']."</b></span></p>
                    <img class='perfil-redondo' src='".$columna['imagen']."' alt=''>";
        }
    }

    function consulta_acceso()
    {
        $buscarUsuario = "call consulta_login('$_SESSION[email]')";
        $result = conectar()->query($buscarUsuario);
        if ($columna = mysqli_fetch_array( $result ))
		{
            return $columna['id_perfil'];
        }
    }

    function consulta_menu()
    {
        $id_usuario = $_SESSION['id_user'];
        $consulta = "call consulta_menu_usuario($_SESSION[id_user])";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		while ($columna = mysqli_fetch_array( $resultado ))
		{
            if($columna['id_menu'] == 9 || $columna['id_menu'] == 8){}
            else
            {
                echo    "<li>
                            <div class='d-flex align-items-center pl-3 pb-1'>
                                <img width='35px' height='35px' src='".$columna['icono']."' alt=''>";
                                
                                if(consulta_existe_sub_menu($columna['id_menu']) > 0)
                                {
                                    echo    "<a href='#".$columna['href']."' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'>".$columna['menu']."</a>";
                                }

                                else
                                {
                                    echo    "<a href='".$columna['href']."'>".$columna['menu']."</a>";
                                }

                    echo    "</div>";

                            if(consulta_existe_sub_menu($columna['id_menu']) > 0)
                            {
                                echo    "<ul class='collapse list-unstyled' id='".$columna['href']."'>";
                                            consulta_sub_menu($columna['id_menu'],$id_usuario);
                                echo    "</ul>";
                            }

                echo    "</li>";
            }
		}
    }

    function consulta_menu_inferior()
    {
        $consulta = "call consulta_menu()";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

        echo "<ul class='list-unstyled components'>";

		while ($columna = mysqli_fetch_array( $resultado ))
		{
            if($columna['id_menu'] == 9 || $columna['id_menu'] == 8)
            {
                if($columna['id_menu'] == 8)
                {
                    echo    "<li>
                                <div class='d-flex align-items-center pl-3 pb-1'>
                                    <img width='35px' height='35px' src='".$columna['icono']."' alt=''>
                                    <a href='".$columna['href']."'>".$columna['menu']."</a>
                                </div>
                            </li>";    
                }

                else
                {
                    echo    "<li>
                                <div class='d-flex align-items-center pl-3 pb-1'>
                                    <img width='35px' height='35px' src='".$columna['icono']."' alt=''>
                                    <a href='#' data-toggle='modal' data-target='#".$columna['href']."'>".$columna['menu']."</a>
                                </div>
                            </li>";    
                }
            }   
        }

        echo "</ul>";
    }

    function consulta_sub_menu($menu,$user)
    {
        $consulta = "call consulta_acceso_sub_menu($menu,$user)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		while ($columna = mysqli_fetch_array( $resultado ))
		{
            if($columna['acceso'] == 1)
            {
                echo    "<li>
                            <a class='pt0 pb-0' href='".$columna['href']."'>".$columna['submenu']."</a>
                        </li>";
            }
			
		}
    }
    
    function consulta_existe_sub_menu($menu)
    {
        $consulta = "call consulta_sub_menu($menu)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        $count = mysqli_num_rows($resultado);
        return $count;
    }

    function consulta_perfil_usuario($email)
    {
        $consulta = "call consulta_login('$email')";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		if ($columna = mysqli_fetch_array( $resultado ))
		{ 
			echo    "<div class='col-md-12 col-lg-7'>
                        <div class='col-lg-12 mt-2'>
                            <label>Nombre</label>
                            <input type='text' class='form-control' placeholder='Ingrese nombre' value='".$columna['nombre']."' name='nombre'>
                        </div>
                        <div class='col-lg-12 mt-2'>
                            <label>Email</label>
                            <input type='email' class='form-control' placeholder='Ingrese correo' value='".$columna['email']."' name='email' disabled>
                        </div>
                        <div class='col-lg-12 mt-2'>
                            <label>Dirección</label>
                            <input type='text' class='form-control' placeholder='Ingrese dirección' value='".$columna['direccion']."' name='direccion'>
                        </div>
                        <div class='col-lg-12 mt-2'>
                            <label>Teléfono</label>
                            <div class='input-group'>
                                <div class='input-group-prepend'>
                                    <div class='input-group-text'>+56 9</div>
                                </div>    
                                <input type='text' class='form-control' placeholder='Ingrese teléfono' value='".$columna['telefono']."' name='telefono' minlength='8' maxlength='8' pattern='[0-9]{8}'>
                                <input type='hidden' value='".$columna['id_usuario']."' name='id'/>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12 col-lg-5'>
                        <div class='col-lg-12 d-flex justify-content-center mb-3'>
                            <img src='".$columna['imagen']."' alt='' class='pt-3 rounded-circle' id='imagenmuestra1' style='object-fit:cover;width:280px;height:300px;'>
                            <div class='image-upload position-absolute'>
                                <label for='file-input'>
                                    <img src='img/iconos/camara.svg'/> 
                                </label>

                                <input type='file' name='imagen' id='file-input'/>
                            </div>
                        </div>
                    </div>";
		}
    }

    function consulta_tipo_perfil()
    {
        $consulta = "call consulta_tipo_perfil()";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		while ($columna = mysqli_fetch_array( $resultado ))
		{ 
			echo    "<option value='".$columna['id_perfil']."'>".$columna['tipo']."</option>";
		}
    }
    
    function consulta_tipo_pago()
    {
        $consulta = "call consulta_tipo_pago()";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		while ($columna = mysqli_fetch_array( $resultado ))
		{ 
			echo    "<option value='".$columna['id_tipo_pago']."'>".$columna['tipo']."</option>";
		}
    }

    function consulta_acceso_pagina()
    {
        $token="";
        $id_usuario = $_SESSION['id_user'];
        $token = strtok($_SERVER["REQUEST_URI"], "/");
        while($token !== false) {
            $_SESSION['page'] = $token;
            $consulta = "call consulta_acceso_pagina('$token',$id_usuario)";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                return $columna['agregar'];
            }
        }
    }

    function consulta_acceso_sub_pagina()
    {
        $token="";
        $id_usuario = $_SESSION['id_user'];
        $token = strtok($_SERVER["REQUEST_URI"], "/");
        while($token !== false) {
            $token = strtok("/");
            $_SESSION['page'] = $token;
            $consulta = "call consulta_acceso_sub_pagina('$token',$id_usuario)";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            { 
                return $columna['agregar'];
            }
        }
    }

?>