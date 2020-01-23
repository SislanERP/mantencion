<?php
    session_start();
    include ('../../conexion.php');
    
    $producto = $_POST['id_producto'];

    $consulta = "SELECT max(id_registro) as correlativo FROM temporal";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    $consulta = "SELECT * FROM productos where id_producto=$producto";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{
        if($columna['stock'] > 0)
        {
            $venta = $_SESSION['n_venta'];
            $query="INSERT INTO temporal (id_registro,id_venta,codigo,cantidad) values($contador,$venta,'$columna[codigo]',1)";
            if (conectar()->query($query) === TRUE) 
            {
            }
        }
        else
        {
            $errors []= "Producto no cuenta con stock";
        }
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
            if (isset($messages)){
                
                ?>
                <div class="alert alert-success" role="alert">
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