<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
	<thead>
		<tr>
			<td><b>#Mes</b></td>
			<td><b>Mes</b></td>
			<td><b>Tarifa</b></td>
			<td><b>Porcentaje</b></td>
			<td><b>Fecha</b></td>
			<td colspan=2 align="center"><b>Acciones</b></td>
		</tr>
	</thead>
	<?php foreach ($months as $month) { ?>
	<tbody>
		<tr>
			<td><?php echo $month->codigo_month; ?></td>
			<td><?php echo $month->mes; ?></td>
			<td><?php echo $month->tarifa; ?></td>
			<td><?php echo $month->porcentaje; ?></td>
			<td><?php echo $month->fecha; ?></td>
			<td><a class="btn btn-secondary" href="?controller=month&action=formulario_modificar&codigo_month=<?php echo $month->codigo_month ?>">Actualizar</a></td>
			<!-- <td><a class="btn btn-danger" href="?controller=month&action=eliminar_month&codigo_month=<?php echo $month->codigo_month ?>">Eliminar</a> </th> -->
		</tr>
	</tbody>			
	<?php } ?>
	<tfoot>
		<tr>
			<td><b>#Mes</b></td>
			<td><b>Mes</b></td>
			<td><b>Tarifa</b></td>
			<td><b>Porcentaje</b></td>
			<td><b>Fecha</b></td>
			<td colspan=2 align="center"><b>Acciones</b></td>
		</tr>
	</tfoot>
</table>