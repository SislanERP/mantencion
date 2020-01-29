<?php
	require_once("../php/conexion.php");
	session_start();

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	usuarios a inner join 
					tipo_perfil b on a.id_perfil = b.id_perfil left outer join
					areas c on a.id_area = c.id_area";

		$campos="	a.id_usuario as Id,
					a.nombre as Nombre,
					a.email as Email,
					a.direccion as Direccion,
					a.telefono as Telefono,
					b.tipo as Perfil,
					b.id_perfil as Id_perfil,
					a.id_area as id_area,
					c.area as area";
		$sWhere=" a.nombre LIKE '%".$query."%' or a.email LIKE '%".$query."%' or a.direccion LIKE '%".$query."%' or a.telefono LIKE '%".$query."%' or b.tipo LIKE '%".$query."%'";
		$sWhere.=" order by a.nombre";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 4;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'usuarios.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Nombre</th>
				  <th>Email</th>
				  <th>Dirección</th>
				  <th>Teléfono</th>
				  <th>Perfil</th>
				  <th>Área</th>
				  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['Nombre'];?></td>
					<td><?php echo $row['Email'];?></td>
					<td><?php echo $row['Direccion'];?></td>
					<td>+56 9 <?php echo $row['Telefono'];?></td>
					<td><?php echo $row['Perfil'];?></td>
					<td><?php echo $row['area'];?></td>
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
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['Id']?>" data-nombre="<?php echo $row['Nombre']?>" data-perfil="<?php echo $row['Id_perfil']?>" data-area="<?php echo $row['id_area']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['Id']?>" data-nombre="<?php echo $row['Nombre']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
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
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>

		  