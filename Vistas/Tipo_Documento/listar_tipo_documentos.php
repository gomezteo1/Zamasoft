<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
	<thead>
		<tr>
			<td><b>Serial Tipo Documento</b></td>
			<td><b>Documento</b></td>
			<td colspan=3><b>Acciones</b></td>
		</tr>
	</thead>
	<?php foreach ($tipo_documentos as $tipo_documento) { ?>
	<tbody>
		<tr>
			<td><?php echo $tipo_documento->id_tipo_documento; ?></td>
			<td><?php echo $tipo_documento->documento; ?></td>
			<td><a class="btn btn-secondary" href="?controller=tipo_documento&action=formulario_modificar&id_tipo_documento=<?php echo $tipo_documento->id_tipo_documento ?>">Actualizar</a></td>
			<!-- <td><a class="btn btn-danger" href="?controller=tipo_documento&action=eliminar_tipo_documento&id_tipo_documento=<?php echo $tipo_documento->id_tipo_documento ?>">Eliminar</a> </th> -->
		</tr>		
	</tbody>
	<?php } ?>
	<tfoot>
		<tr>
			<td><b>Serial Tipo Documento</b></td>
			<td><b>Documento</b></td>
			<td colspan=3><b>Acciones</b></td>
		</tr>
	</tfoot>
</table>