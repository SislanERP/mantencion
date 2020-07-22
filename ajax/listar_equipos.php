<?php
	require_once("../php/conexion.php");
	session_start();

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	equipos a left outer join 
					ubicaciones b on a.id_ubicacion = b.id_ubicacion left outer join
					lineas c on a.id_linea = c.id_linea";
		$campos="	a.id_equipo as id, 
					a.equipo as equipo, 
					a.marca as marca, 
					b.ubicacion as ubicacion, 
					a.caracteristicas as caracteristicas, 
					a.imagen as imagen, 
					a.id_ubicacion as id_ubicacion,
					a.id_linea as id_linea,
					c.linea as linea";
		$sWhere=" a.equipo LIKE '%".$query."%' or a.marca LIKE '%".$query."%' or c.linea LIKE '%".$query."%' or b.ubicacion LIKE '%".$query."%'";
		$sWhere.=" order by id_equipo desc";

        include 'pagination.php'; 

        $page = getPaginationPos();
		$per_page = 8;
        $adjacents  = 8;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'equipos.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Equipo</th>
				  <th>Marca</th>
				  <th>Ubicación</th>
				  <th>Línea</th>
				  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<?php
                        if(empty($row['imagen']))
                        {
                            echo "<td>".$row['equipo']."</td>";
                        }
                        else{
					        echo "<td><a href='#' data-toggle='modal' data-target='#Imagen' data-imagen='".$row['imagen']."'>".$row['equipo']."</a></td>";
                        }
                    ?>
					<td><?php echo $row['marca'];?></td>
					<td><?php echo $row['ubicacion'];?></td>
					<td><?php echo $row['linea'];?></td>
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
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-nombre="<?php echo $row['equipo']?>" data-marca="<?php echo $row['marca']?>" data-ubicacion="<?php echo $row['id_ubicacion']?>" data-linea="<?php echo $row['id_linea']?>" data-caracteristicas="<?php echo $row['caracteristicas']?>" data-imagen="<?php echo $row['imagen']?>" data-img="<?php echo "img".$row['id']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}
						?>
						<?php
								if($columna['eliminar'] == 1){
						?>
									<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-nombre="<?php echo $row['equipo']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
								}
							}
						?>
		
						<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-nombre="<?php echo $row['equipo']?>"><img src="img/iconos/pdf.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
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
<?php 
function getPaginationPos(){
	if (isset($_REQUEST['page']) && !empty($_REQUEST['page']))
	{
		setcookie('page_equipos',$_REQUEST['page'],time() + 86400);
		return $_REQUEST['page'];
	} 
	else 
	{
		return ($_COOKIE['page_equipos']!='' ? $_COOKIE['page_equipos'] : 1);
	}
	
}
?>
		  