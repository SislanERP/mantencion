<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

	$consulta1 = "call consulta_area_usuario($id_usuario)";
	$resultado1 = mysqli_query(conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna1 = mysqli_fetch_array( $resultado1 ))
	{
		$area = $columna1['id_area'];
	}

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
		// if($query == "en proceso"){$ejec = 0;}else if($query="terminado"){$ejec= 1;} else {$ejec= "";}

        $tables="	desviaciones a inner join areas b on a.id_area = b.id_area inner join
                    productos c on a.id_producto = c.id_producto inner join
                    fase_del_proceso d on a.id_fase = d.id_fase inner join
                    personal_calidad e on a.id_personal = e.id_personal inner join
                    int_estados_calidad f on a.id_estado = f.id_estado";

        $campos="	a.id_desviacion as id,
                    a.fecha as fecha,
                    b.area as area,
                    a.id_area as id_area,
                    a.id_producto as id_producto,
                    c.producto as producto,
                    a.id_fase as id_fase,
                    d.fase as fase,
                    a.id_personal as id_personal,
                    e.nombre as detector,
                    a.id_estado as id_estado,
                    f.estado as estado,
                    a.desviacion as desviacion,
                    a.consecuencia as consecuencia,
                    a.acciones as acciones,
                    a.responsable as responsable,
					a.observaciones as observaciones,
					a.log_ejecucion as ejecucion,
					a.fec_ejecucion as fec_ejecucion";
		if($columna1['id_area'] == 10 or $columna1['id_area'] == 3)
		{
			
			$sWhere=" a.fecha LIKE '%".$query."%' or f.estado LIKE '%".$query."%' or b.area LIKE '%".$query."%' or a.id_desviacion LIKE '%".$query."%'";
			$sWhere.=" order by a.id_desviacion desc";	
		}

		else{
			$sWhere="a.id_area =".$columna1['id_area']."";
			$sWhere.=" order by a.id_desviacion desc";
		}
		

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 6;
        $adjacents  = 6;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'desviaciones.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
                    <th>AC</th>
                    <th>Fecha</th>
                    <th>Área</th>
                    <th>Producto</th>
                    <th>Fase Proceso</th>
					<th>Detectado Por</th>
					<th>Ejecución</th>
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
					<td><?php echo $row['area'];?></td>
					<td><?php echo $row['producto'];?></td>
					<td><?php echo $row['fase'];?></td>
					<td><?php echo $row['detector'];?></td>
					<td><?php if($row['ejecucion'] == 0){echo "En Proceso";}else{echo "Terminado";}?></td>
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
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-fecha="<?php echo $row['fecha']?>" data-area="<?php echo $row['id_area']?>" data-producto="<?php echo $row['id_producto']?>" data-fase="<?php echo $row['id_fase']?>" data-personal="<?php echo $row['id_personal']?>" data-desviacion="<?php echo $row['desviacion'];?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
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
                        <button type="button" class="btn p-0" data-toggle="modal" data-target="#dataResponder" data-id="<?php echo $row['id']?>" data-desviacion="<?php echo $row['desviacion']?>" data-consecuencia="<?php echo $row['consecuencia']?>" data-acciones="<?php echo $row['acciones']?>" data-responsable="<?php echo $row['responsable']?>" data-observaciones="<?php echo $row['observaciones']?>" data-estado="<?php echo $row['id_estado']?>" data-ejecucion="<?php echo $row['ejecucion']?>" data-fec_ejecucion="<?php echo $row['fec_ejecucion']?>" data-area="<?php echo $columna1['id_area'];?>" data-depa="<?php echo $row['id_area']?>"><img src="img/iconos/ver.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
                        <?php if($row['id_estado'] ==  2){?>
                            <a href='php/acciones/report/report_desviaciones.php?id=<?php echo $row['id']?>' target="_blank" class="btn p-0"><img src="img/iconos/pdf.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></a>                        
                        <?php }?>
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

		  