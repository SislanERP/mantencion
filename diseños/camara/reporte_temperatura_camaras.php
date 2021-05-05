<?php
    session_start();
    require_once("../../php/conexion.php");

    $desde = $_SESSION['temperatura_camaras_desde']; 
    $hasta = $_SESSION['temperatura_camaras_hasta']; 

    header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
    header('Content-Disposition: attachment; filename=temperaturas.xls');

    $consulta = "select 
                    a.id_registro as id,
                    b.nombre as ubicacion,
                    a.fecha as fecha,
                    a.valor as temperatura
                from 
                    historial_camara a inner join 
                    memorias b on a.id_memoria = b.id_registro
                where
                    date(a.fecha) between '".$desde."' and '".$hasta."'
                order by
                    a.fecha	asc";
    $resultado = mysqli_query(conectar(), $consulta );
    
?>
    <table class="table">
		<thead class="thead-light">
			<tr>
                <th>Ubicación</th>
				<th>Fecha</th>
                <th>Hora</th>
                <th>Temperatura</th>
			</tr>
		</thead>
<?php
            while($row = mysqli_fetch_array($resultado)){
?>
				<tr>
                    <td><?=$row['ubicacion']?></td>
					<td><?php echo date("d/m/Y", strtotime($row['fecha']));?></td>
					<td><?php $hora = strtotime($row['fecha']);echo date("H:i",$hora);?></td>
                    <td><?=$row['temperatura']?> °C</td>
				</tr>
<?php
			}
?>
		</tbody>
	</table>
