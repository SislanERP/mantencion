<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	preventivos a inner JOIN
                    equipos c on a.id_equipo = c.id_equipo inner join
                    tipo_mantenimiento e on a.id_tipo_mantenimiento = e.id_tipo_mantenimiento inner join
                    usuarios d on a.id_usuario_registro = d.id_usuario inner join
					usuarios f on a.id_responsable = f.id_usuario inner join
					estados g on a.id_estado = g.id_estado";

		$campos="	a.fec_inicio as fecha,
					c.equipo as equipo,
                    f.nombre as responsable,
					d.nombre as usuario,
					a.id_preventivo as id,
					a.id_equipo as id_equipo,
                    a.id_usuario_registro as id_usuario,
                    a.id_responsable as id_responsable,
					e.tipo as tipo_manteniminento,
					g.estado as estado,
					a.id_estado as id_estado";
		$sWhere=" a.fec_inicio LIKE '%".$query."%' or d.nombre LIKE '%".$query."%' or c.equipo LIKE '%".$query."%' or a.id_preventivo='".$query."' or g.estado='".$query."'";
		$sWhere.=" order by a.id_preventivo desc";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 6;
        $adjacents  = 6;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'correctivos.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Equipo</th>
                    <th>Responsable</th>
					<th>Estado</th>
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
					<td><?php echo $row['equipo'];?></td>
					<td><?php echo $row['responsable'];?></td>
					<td><?php echo $row['estado'];?></td>
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
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-fecha="<?php echo $row['fecha']?>" data-equipo="<?php echo $row['id_equipo']?>" data-responsable="<?php echo $row['id_responsable']?>" data-estado="<?php echo $row['id_estado'];?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}else{
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-fecha="<?php echo $row['fecha']?>" data-equipo="<?php echo $row['id_equipo']?>" data-responsable="<?php echo $row['id_responsable']?>" data-estado="<?php echo $row['id_estado'];?>" disabled><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-fecha="<?php echo date("d/m/Y", strtotime($row['fecha']))?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}else{
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-fecha="<?php echo date("d/m/Y", strtotime($row['fecha']))?>" disabled><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
								}
						?>
                        <?php $_SESSION['id_preventivo'] = $row['id'];?>
                        <a href="php/acciones/report/report_preventivo.php" target="_blank" class="btn p-0"><img src="img/iconos/pdf.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></a>                        
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

		  