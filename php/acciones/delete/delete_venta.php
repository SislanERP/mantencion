<?php 
    session_start();
    include ('../../conexion.php');

    $id=intval($_POST['id']);

    $consulta = "SELECT * FROM venta_detalle where id_venta=$id";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        $consulta1 = "SELECT * FROM productos where codigo='$columna[codigo]'";
        $resultado1 = mysqli_query( conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        if ($columna1 = mysqli_fetch_array( $resultado1 ))
        {
            $stock_producto = $columna1['stock'];
        }

        $stock = $columna['cantidad'] + $stock_producto;
        $query="UPDATE productos set stock= where codigo = '$columna[codigo]'";
        if (conectar()->query($query) === TRUE) 
        {
            
        }
    }
		
	$sql="DELETE FROM venta WHERE id_venta='".$id."'";
	$query_delete = mysqli_query(conectar(),$sql);
	if ($query_delete){
		$messages[] = "La venta ha sido eliminada satisfactoriamente.";
	} else{
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
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