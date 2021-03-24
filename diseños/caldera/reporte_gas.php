<?php
    session_start();
    require_once("../../php/conexion.php");

    $desde = $_SESSION['totalizador_gas_desde']; 
    $hasta = $_SESSION['totalizador_gas_hasta']; 

    header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
    header('Content-Disposition: attachment; filename=caldera_gas.xls');

    $consulta = "SELECT
					a.fecha as fecha,
					a.hora_encendido as inicio,
					a.hora_apagado as detencion,
					(select x1.entrada from detalle_caldera x1 where x1.id_control = a.id_control and x1.id_tipo = 2 order by x1.id_registro asc limit 1) as entrada,
					(select x2.salida from detalle_caldera x2 where x2.id_control = a.id_control and x2.id_tipo = 2  order by x2.id_registro desc limit 1) as salida
				FROM 
					caldera a inner join 
					detalle_caldera b on a.id_control = b.id_control
				WHERE
					b.id_tipo = 2 and date(a.fecha) between '".$desde."' and '".$hasta."'
				ORDER BY
					a.fecha";
    $resultado = mysqli_query(conectar(), $consulta );
    
?>
    <table class="table">
		<thead class="thead-light">
			<tr>
				<th>Fecha</th>
				<th>Hora encendido</th>
                <th>Hora apagado</th>
                <th>Entrada m³</th>
                <th>Salida m³</th>
                <th>Total día m³</th>
			</tr>
		</thead>
<?php
            while($row = mysqli_fetch_array($resultado)){
?>
				<tr>
					<td><?php echo date("d/m/Y", strtotime($row['fecha']));?></td>
					<td><?php $entrada = strtotime($row['inicio']);echo date("H:i",$entrada);?></td>
                    <td><?php $salida = strtotime($row['detencion']);echo date("H:i",$salida);?></td>
                    <td><?=$row['entrada']?></td>
                    <td><?=$row['salida']?></td>
                    <td><?=$row['salida'] - $row['entrada']?></td>
				</tr>
<?php
				$dia = $row['salida'] - $row['entrada'];
				$total = $total + $dia;
			}
?>
		</tbody>
	</table>  


    <table class="table">
		<tbody>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="font-weight:bolder;background:yellow;">Totalizador</td>
				<td style="font-weight:bolder;background:yellow;"><?=$total?></td>
			</tr>
		</tbody>
	</table>  
