<?php
    session_start();
    include ('../../conexion.php');

    $target_path = "../../../img/perfil/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    if(empty($_POST["actual"]) && empty($_POST["nueva"]) && empty($_POST["confirmar"]))
    {
        $target = $target_path . basename( $_FILES['imagen']['name']);
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
        {
            $query="UPDATE usuarios set nombre = '$_POST[nombre]', direccion = '$_POST[direccion]', telefono = '$_POST[telefono]', imagen = 'img/perfil/".$_FILES['imagen']['name']."',temporal=0 where id_usuario = $_POST[id]";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Los datos han sido actualizados satisfactoriamente.";
            }
        }

        else
        {
            $query="UPDATE usuarios set nombre = '$_POST[nombre]', direccion = '$_POST[direccion]', telefono = '$_POST[telefono]',temporal=0 where id_usuario = $_POST[id]";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Los datos han sido actualizados satisfactoriamente.";
            }
        }
    }

    else
    {
        if(empty($_POST["actual"]) || empty($_POST["nueva"]) || empty($_POST["confirmar"]))
        {
            $errors []= "Para cambiar contraseña, debe completar todos los campos solicitados.".mysqli_error(conectar());
        }
        else
        {
            $contraseña = $_POST['actual'];
            $actual = $_POST['nueva'];
            $confirmar = $_POST['confirmar'];
            $buscarUsuario = "call consulta_login('$_SESSION[email]')";
            $result = conectar()->query($buscarUsuario);
            if ($columna = mysqli_fetch_array( $result ))
            {
                if (password_verify(htmlentities($contraseña), $columna['password'])) 
                {
                    if($actual == $confirmar)
                    {
                        $hash = password_hash($actual, PASSWORD_DEFAULT);
                        $target = $target_path . basename( $_FILES['imagen']['name']);
                        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
                        {
                            $query="UPDATE usuarios set nombre = '$_POST[nombre]', direccion = '$_POST[direccion]', telefono = '$_POST[telefono]', imagen = 'img/perfil/".$_FILES['imagen']['name']."',password='$hash', temporal=0 where id_usuario = $_POST[id]";
                            if (conectar()->query($query) === TRUE) 
                            {
                                $messages[] = "Los datos han sido actualizados satisfactoriamente.";
                            }
                        }

                        else
                        {
                            $query="UPDATE usuarios set nombre = '$_POST[nombre]', direccion = '$_POST[direccion]', telefono = '$_POST[telefono]',password='$hash', temporal=0 where id_usuario = $_POST[id]";
                            if (conectar()->query($query) === TRUE) 
                            {
                                $messages[] = "Los datos han sido actualizados satisfactoriamente.";
                            }
                        }
                    }
                    else
                    {
                        $errors []= "Contraseña nueva no coincide con la contraseña confirmada.".mysqli_error(conectar());
                    }
                }
                else
                {
                    $errors []= "Contraseña actual erronea.".mysqli_error(conectar());
                }
            }
        }
    }

    

    if (isset($errors)){
			
        ?>
            <div class="alert alert-danger" role="alert" style="z-index:1000">
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
            if (isset($messages)){
                
                ?>
                <div class="alert alert-success" role="alert" style="z-index:1000">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Bien hecho!</strong>
                        <?php
                            foreach ($messages as $message) {
                                    echo $message;
                                }
                            ?>
                </div>
                <?php
            }
?>