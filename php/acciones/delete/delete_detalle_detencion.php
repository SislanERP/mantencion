<?php 
    session_start();
    include ('../../conexion.php');

    $id=intval($_POST['id_detalle']);
		
		$sql="DELETE FROM detalle_detencion WHERE id_registro='".$id."'";
		$query_delete = mysqli_query(conectar(),$sql);
			if ($query_delete){
				$messages[] = "El detalle ha sido eliminado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
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