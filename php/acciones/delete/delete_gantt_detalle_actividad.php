<?php 
    session_start();
    include ('../../conexion.php');

    $id = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
		
		$sql="DELETE FROM gantt_detalle_actividad WHERE id_registro='".$id."'";
		$query_delete = mysqli_query(conectar(),$sql);
			if ($query_delete){
				$messages[] = "La actividad ha sido eliminada satisfactoriamente.";
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