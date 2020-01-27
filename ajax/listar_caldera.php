<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	detalle_caldera a inner JOIN
					turnos b on a.id_turno = b.id_turno inner JOIN
					tipo_consumo c on a.id_tipo = c.id_tipo inner join
					usuarios d on a.id_usuario_registro = d.id_usuario inner join
					caldera e on a.id_control = e.id_control";

		$campos="	a.id_registro as id_registro,
					b.turno as turno,
					c.consumo as consumo,
					a.id_tipo as id_tipo,
					a.entrada as entrada,
                    a.salida as salida,
                    a.total as total,
					d.nombre as usuario,
					a.id_control as id,
					a.id_tipo as id_tipo,
					a.id_turno as id_turno,
					a.id_usuario_registro as id_usuario";
		$sWhere=" e.fecha LIKE '%".$query."%' or d.nombre LIKE '%".$query."%' or c.consumo LIKE '%".$query."%'";
		$sWhere.=" order by a.id_registro desc";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 4;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'caldera.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Turno</th>
				  <th>Consumo</th>
				  <th>M³ (Entrada)</th>
                  <th>M³ (Salida)</th>
                  <th>M³ (Total)</th>
				  <th>Usuario</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['turno'];?></td>
					<td><?php echo $row['consumo'];?></td>
					<td><?php echo $row['entrada']." m³";?></td>
					<td><?php echo $row['salida']." m³";?></td>
                    <td><?php if($row['id_tipo'] == 1){$total = $row['total'] * 10; echo $total." m³";}else{echo $row['total']." m³";}?></td>
					<td><?php echo $row['usuario'];?></td>
					<td>
						<?php
								$id_usuario = $_SESSION['id_user'];
								$token = $_SESSION['page'];
								$consulta = "call consulta_acceso_sub_pagina('$token',$id_usuario)";
								$resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
								while ($columna = mysqli_fetch_array( $resultado ))
								{ 
									if($columna['editar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id_registro']?>" data-turno="<?php echo $row['id_turno']?>" data-tipo="<?php echo $row['id_tipo']?>" data-entrada="<?php echo $row['entrada']?>" data-salida="<?php echo $row['salida']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}else{
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id_registro']?>" data-turno="<?php echo $row['id_turno']?>" data-tipo="<?php echo $row['id_tipo']?>" data-entrada="<?php echo $row['entrada']?>" data-salida="<?php echo $row['salida']?>" disabled><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id_registro']?>" data-tipo="<?php echo $row['consumo']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}else{
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id_registro']?>" data-tipo="<?php echo $row['consumo']?>" disabled><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
								}
						?>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable mt-3">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>

		  