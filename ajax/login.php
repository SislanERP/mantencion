<?php
    session_start();
    require_once("../php/conexion.php");
    
    $email = $_POST['email_login'];
    $contraseña = $_POST['password_login'];
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
            if($columna['id_perfil'] == 1)
            {
                if($columna['temporal'])
                {
                    echo "2";
                }else{echo "1";}
            }

            else
            {
                if($columna['temporal'])
                {
                    echo "2";
                }else{echo "1";}
            }
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
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> 
                    <?php
                        foreach ($errors as $error) {
                                echo $error;
                            }
                        ?>
            </div>
            <?php
            }
    
?>