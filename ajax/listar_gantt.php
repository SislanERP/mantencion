<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	gantt a 
					";

		$campos="	a.id_gantt as id,
					a.fec_inicio as inicio,
                    a.fec_termino as termino,
                    a.año as año";
		$sWhere=" a.fec_inicio LIKE '%".$query."%' or a.fec_termino LIKE '%".$query."%' or a.año LIKE '%".$query."%'";
		$sWhere.=" order by a.id_gantt desc";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10;
        $adjacents  = 10;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}else{$numrows=0;}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'gantt.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
                    <th>N°</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Termino</th>
                    <th>Año</th>
                    <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
                    <td><?php echo $row['id'];?></td>
					<td><?php echo date("d/m/Y", strtotime($row['inicio']));?></td>
					<td><?php echo date("d/m/Y", strtotime($row['termino']));?></td>
					<td><?php echo $row['año'];?></td>
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
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-inicio="<?php echo $row['inicio']?>" data-termino="<?php echo $row['termino']?>" data-año="<?php echo $row['año']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-anio="<?=$row['año']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
                                        <button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDetalle" data-id_gantt="<?php echo $row['id']?>"><img src="img/iconos/ver.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
										<a href="cronograma.php?id=<?=$row['id']?>" target="_blank"><img src="img/iconos/registros.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></a>
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

		  