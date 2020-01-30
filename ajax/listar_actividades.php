<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
		$_SESSION['fecha_actividades'] = $query;

		$tables="	actividades a inner JOIN
					turnos b on a.id_turno = b.id_turno inner JOIN
					estados c on a.id_estado = c.id_estado inner join
					usuarios d on a.id_usuario_registro = d.id_usuario inner join
					equipos e on a.id_equipo = e.id_equipo";

		$campos="	a.fecha as fecha,
					b.turno as turno,
					c.estado as estado,
					a.actividad as actividad,
					a.detalle as detalle,
					d.nombre as usuario,
					a.id_registro as id,
					a.id_estado as id_estado,
					a.id_turno as id_turno,
					a.id_usuario_registro as id_usuario,
					a.id_equipo as id_equipo,
					e.equipo as equipo";
		$sWhere=" a.fecha= '".$query."'";
		$sWhere.=" order by a.id_registro";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 6;
        $adjacents  = 6;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'actividades.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Fecha</th>
				  <th>Turno</th>
				  <th>Equipo</th>
				  <th>Estado</th>
				  <th>Actividad</th>
				  <th>Usuario</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo date("d/m/Y", strtotime($row['fecha']));?></td>
					<td><?php echo $row['turno'];?></td>
					<td><?php echo $row['equipo'];?></td>
					<td><?php echo $row['estado'];?></td>
					<td><?php echo $row['actividad'];?></td>
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
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-fecha="<?php echo $row['fecha']?>" data-turno="<?php echo $row['id_turno']?>" data-estado="<?php echo $row['id_estado']?>" data-actividad="<?php echo $row['actividad']?>" data-detalle="<?php echo $row['detalle']?>" data-equipo="<?php echo $row['id_equipo']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-actividad="<?php echo $row['actividad']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
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

		  