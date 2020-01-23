<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['fecha'], ENT_QUOTES)));

        $tables="	detalle_sala_maquinas a inner join
                    maquinas b on a.id_maquina = b.id_maquina inner join
                    usuarios d on a.id_usuario_registro = d.id_usuario inner join
                    sala_maquinas e on a.id_control = e.id_control";

        $campos="	a.id_registro as id,
                    a.id_control as id_control,
                    a.id_maquina as id_maquina,
                    b.maquina as maquina,
                    a.hora_inicio_c as hora_inicio_c,
                    a.hora_termino_c as hora_termino_c,
                    a.temperatura as temperatura,
                    d.nombre as usuario,
                    a.id_usuario_registro as id_usuario";
		$sWhere=" e.fecha = '".$query."'";
		$sWhere.=" order by a.id_registro desc";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 4;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'sala_maquinas.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Equipo</th>
				  <th>Temperatura</th>
				  <th>H.Inicio Congelación</th>
                  <th>H.Termino Congelación</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['maquina'];?></td>
					<td><?php echo $row['temperatura']." °C";?></td>
                    <td><?php $inicio = strtotime($row['hora_inicio_c']);echo date("H:i",$inicio);?></td>
                    <td><?php $termino = strtotime($row['hora_termino_c']);echo date("H:i",$termino);?></td>
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
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-equipo="<?php echo $row['id_maquina']?>" data-temperatura="<?php echo $row['temperatura']?>" data-inicio="<?php $inicio = strtotime($row['hora_inicio_c']);echo date("H:i",$inicio)?>" data-termino="<?php $termino = strtotime($row['hora_termino_c']);echo date("H:i",$termino)?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}else{
						?>
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-equipo="<?php echo $row['id_maquina']?>" data-temperatura="<?php echo $row['temperatura']?>" data-inicio="<?php $inicio = strtotime($row['hora_inicio_c']);echo date("H:i",$inicio)?>" data-termino="<?php echo $termino = strtotime($row['hora_termino_c']);echo date("H:i",$termino)?>" disabled><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}
						?>
						<?php
								if($columna['eliminar'] == 1){
						?>
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-equipo="<?php echo $row['maquina']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}else{
						?>
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-equipo="<?php echo $row['maquina']?>" disabled><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
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

		  