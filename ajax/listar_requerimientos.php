<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

	$consulta = "call consulta_area_usuario($id_usuario)";
	$resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{
		$area = $columna['id_area'];
	}
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

        $tables="	requerimientos a inner join
                    estados b on a.id_estado = b.id_estado left outer join
                    prioridades c on a.id_prioridad = c.id_prioridad left outer join
                    trabajadores d on a.id_trabajador = d.id_trabajador";

        $campos="	a.id_requerimiento as id,
                    a.actividad as actividad,
                    a.id_estado as id_estado,
                    b.estado as estado,
                    a.fec_registro as fecha,
                    a.id_prioridad as id_prioridad,
                    c.prioridad as prioridad,
                    a.id_trabajador as id_trabajador,
                    d.nombre as trabajador,
                    a.imagen as imagen,
                    a.desarrollo as desarrollo,
                    a.log_terminado as log_terminado";
		
		$sWhere=" a.id_estado LIKE '%".$query."%'";
		$sWhere.=" order by a.id_requerimiento desc";
		
		

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 6;
        $adjacents  = 6;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'requerimientos.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Prioridad</th>
                    <th>Responsable</th>
					<th>Estado</th>
					<th>Terminado?</th>
                    <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
                    <td><?php echo $row['id'];?></td>
					<td><?php echo date("d/m/Y", strtotime($row['fecha']));?></td>
					<td><?php echo $row['prioridad'];?></td>
					<td><?php echo $row['trabajador'];?></td>
					<td><?php echo $row['estado'];?></td>
					<td>
						<?php 
							if ($row['log_terminado'] == 1){
						?>
							<img src="img/iconos/no.svg" alt="" class="btn-accion align-self-center" style="width:24px;">
						<?php		
							}else{
						?>
							<img src="img/iconos/si.svg" alt="" class="btn-accion align-self-center" style="width:24px;">
						<?php
							}
						?>
					</td>
					<td>
						<?php
								$id_usuario = $_SESSION['id_user'];
								$token = $_SESSION['page'];
								$consulta = "call consulta_acceso_pagina('$token',$id_usuario)";
								$resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
								while ($columna = mysqli_fetch_array( $resultado ))
								{ 
									if($columna['editar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-actividad="<?php echo $row['actividad']?>" data-imagen="<?php echo $row['imagen']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
                                    }
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
								}
						?>
						
                        <button type="button" class="btn p-0" data-toggle="modal" data-target="#dataResponder" data-id="<?php echo $row['id']?>" data-actividad="<?php echo $row['actividad']?>" data-imagen="<?php echo $row['imagen']?>" data-area="<?php echo $area?>" data-prioridad="<?php echo $row['id_prioridad']?>" data-estado="<?php echo $row['id_estado']?>" data-desarrollo="<?php echo $row['desarrollo']?>" data-terminado="<?php echo $row['log_terminado']?>" data-responsable="<?php echo $row['id_trabajador']?>"><img src="img/iconos/ver.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
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

		  