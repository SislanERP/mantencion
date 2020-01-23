<?php
    session_start();
    include ('../../conexion.php');
    
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

    $consulta1 = "SELECT * FROM productos where codigo='$_POST[codigo]'";
	$resultado1 = mysqli_query( conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna1 = mysqli_fetch_array( $resultado1 ))
	{ 
        if($columna1['stock'] > 0)
        {
            $venta = $_SESSION['n_venta'];
            $query="INSERT INTO temporal (id_registro,id_venta,codigo,cantidad) values($contador,$venta,'$_POST[codigo]',1)";
            if (conectar()->query($query) === TRUE) 
            {
            }
        }
        else
        {
            $errors []= "Producto no cuenta con stock";
        }
    }
    else
    {
        $errors []= "Lo siento codigo no se encuentra en la base de datos";
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