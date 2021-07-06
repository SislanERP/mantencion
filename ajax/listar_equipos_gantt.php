<?php
	session_start();
	require_once("../php/conexion.php");

    $gantt = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$tables="	gantt_detalle_equipo a inner join
                equipos b on a.id_equipo = b.id_equipo";

	$campos="	a.id_registro as id,
                b.equipo as equipo,
                a.id_gantt as gantt";
	$sWhere=" a.id_gantt = $gantt";

    include 'pagination.php'; 

    $page = 1;
	$per_page = 1000;
    $adjacents  = 1000;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);
	$reload = 'gantt.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

    if ($numrows>0){
?>
	<table class="table mt-2">
			  <thead class="thead-light">
				<tr>
				  <th>Equipo</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
                    <td><?php echo $row['equipo'];?></td>
					<td>
                        <div class="d-flex">
                            <form id="Eliminar<?=$row['id']?>">
                                <input type="hidden" id='id_registro<?=$row['id']?>' value="<?=$row['id']?>"/>
                                <input type="hidden" id='id_gantt<?=$row['gantt']?>' value="<?=$row['gantt']?>"/>
                                <button type="submit" class="btn p-0"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
                            </form>

                            <form id="Actividades<?=$row['id']?>" class="ml-3">
                                <input type="hidden" id='id_registro_equipo<?=$row['id']?>' value="<?=$row['id']?>"/>
                                <button type="submit" class="btn p-0"><img src="img/iconos/calidad.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
                            </form>
                        </div>
                    </td>
				</tr>

                <script>
                    $( "#Eliminar<?=$row['id']?>" ).submit(function( event ) {
                        var id = $("#id_registro<?=$row['id']?>").val();
                        var parametros = {'query':id};
                        $.ajax({
                            url: "php/acciones/delete/delete_gantt_detalle_equipo.php",
                            data: parametros,
                            success: function(data){
                                $(".mensaje_gantt_equipo").show();
                                $(".mensaje_gantt_equipo").html(data);
                                setTimeout(function() { $('.mensaje_gantt_equipo').fadeOut('fast'); }, 3000);

                                var id = $("#id_gantt<?=$row['gantt']?>").val();
                                equipos_gantt(id);

                            }
                        });
                        event.preventDefault();
                    });

                    $( "#Actividades<?=$row['id']?>" ).submit(function( event ) {
                        $(".tab-1").removeClass("d-none");
                        $("#home-actividades").tab('show');

                        var id = $("#id_registro_equipo<?=$row['id']?>").val();
                        var parametros = {'query':id};
                        $.ajax({
                            url: "ajax/listar_gantt_actividades.php",
                            data: parametros,
                            success: function(data){
                                $("#listado_actividades_gantt").html(data);
                                $("#id_gantt_equipo").val(id);
                                $("#actividad").val('');
                            }
                        });
                        event.preventDefault();
                    });
                </script>
				<?php
			}
			?>
			</tbody>
		</table>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable mt-3">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	
?>

		  