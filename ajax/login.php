<?php
    session_start();
    require_once("../php/conexion.php");
    
    $email = $_POST['email'];
    $contraseña = $_POST['pass'];
    $buscarUsuario = "call consulta_login('$email')";
    $result = conectar()->query($buscarUsuario);
    if ($columna = mysqli_fetch_array( $result ))
    {  
        if (password_verify(htmlentities($contraseña), $columna['password'])) 
        {
            $_SESSION['email'] = $columna['email'];
            $_SESSION['id_user'] = $columna['id_usuario'];
            $_SESSION['nombre_usuario'] = $columna['nombre'];
            $_SESSION['imagen'] = $columna['imagen'];
            $_SESSION['tiempo'] = time();
            if($columna['temporal'] == 1)
            {
                echo "2";
            }else{echo "1";}
        } 
        
        else
        {
            $errors []= "usuario o contraseña erronea, favor volver a intentar.";
        }
    }
    else
    {
        $errors []= "Correo no se encuentra registrado en la base de datos.";
    }

    if (isset($errors)){
?>
        <div class="alert alert-warning alert-dismissible fade show position-relative" role="alert">
            <span class="alert-icon"><i class="ni ni-air-baloon"></i></span>
            <span class="alert-text"><strong>Error! </strong><?php foreach($errors as $error){echo $error;}?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php
    }
?>