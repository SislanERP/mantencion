<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['fecha'], ENT_QUOTES)));

        $tables="	detalle_detencion a inner join
                    equipos b on a.id_equipo = b.id_equipo inner join
                    tipo_falla c on a.id_tipo_falla = c.id_tipo_falla inner join
                    usuarios d on a.id_usuario_registro = d.id_usuario inner join
                    detenciones e on a.id_detencion = e.id_detencion";

        $campos="	a.id_registro as id,
                    a.id_detencion as id_detencion,
                    a.id_tipo_falla as id_tipo_falla,
                    c.tipo as tipo_falla,
                    a.id_equipo as id_equipo,
                    b.equipo as equipo,
                    a.descripcion as descripcion,
                    a.tiempo as tiempo,
                    a.detencion_proceso as detencion_proceso,
                    d.nombre as usuario,
					a.id_usuario_registro as id_usuario,
					a.hora_falla as falla";
		$sWhere=" e.fecha = '".$query."'";
		$sWhere.=" order by a.id_registro";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 4;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'detencion.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Tipo Falla</th>
				  <th>Equipo</th>
				  <th>Descripción</th>
				  <th>Hora falla</th>
				  <th>Tiempo</th>
                  <th>Detención Proceso</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['tipo_falla'];?></td>
					<td><?php echo $row['equipo'];?></td>
					<td><?php echo $row['descripcion'];?></td>
					<td><?php $falla = strtotime($row['falla']);echo date("H:i",$falla);?></td>
					<td><?php $tiempo = strtotime($row['tiempo']);echo date("H:i",$tiempo);?></td>
                    <td>
						<?php 
							if ($row['detencion_proceso'] == 1){
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
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-tipo_falla="<?php echo $row['id_tipo_falla']?>" data-equipo="<?php echo $row['id_equipo']?>" data-descripcion="<?php echo $row['descripcion']?>" data-falla="<?php strtotime($row['falla']);echo date("H:i",$falla)?>" data-tiempo="<?php strtotime($row['tiempo']);echo date("H:i",$tiempo)?>" data-detencion="<?php echo $row['detencion_proceso']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}else{
						?>
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-tipo_falla="<?php echo $row['id_tipo_falla']?>" data-equipo="<?php echo $row['id_equipo']?>" data-descripcion="<?php echo $row['descripcion']?>" data-falla="<?php strtotime($row['falla']);echo date("H:i",$falla)?>" data-tiempo="<?php strtotime($row['tiempo']);echo date("H:i",$tiempo)?>" data-detencion="<?php echo $row['detencion_proceso']?>" disabled><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}
						?>
						<?php
								if($columna['eliminar'] == 1){
						?>
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-tipo_falla="<?php echo $row['tipo_falla']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}else{
						?>
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-tipo_falla="<?php echo $row['tipo_falla']?>" disabled><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
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

		  