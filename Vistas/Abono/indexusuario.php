<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Index</title>
	
	<!-- Esto es del toogle-->
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script
	  src="https://code.jquery.com/jquery-3.4.1.js"
	  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	  crossorigin="anonymous"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
		

		</div>
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-store"></i>
			</div>
			<div align="left" class="full-width header-well-text">
				<p class="text-condensedLight">
				 Tus Abonos
				</p>
			</div>
		</section>
		<div class="full-width divider-menu-h"></div>
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
				<div class="table-responsive">

				<?php
				?>
				
					<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
						<thead>
							<tr>
								<td><b># Abono</b></td>
								<td><b># Pago</b></td>
								<td><b>Nombre</b></td>
								<td><b>Fecha</b></td>
								<td><b>Deuda</b></td>
								<td><b>Abono</b></td>
								<td><b>Saldo</b></td>
								<td colspan=3 ><b>Acciones</b></td>

								<?php
								foreach ($abonos as $abono) { ?>
									
										<tr>
											<td><?php echo $abono->codigo_abono; ?></td>
											<td><?php echo $abono->nombrePago; ?></td>
											<td><?php echo $abono->nombreUsuario;?></td>
											<td><?php echo $abono->fecha;?></td>
											<td><?php echo $abono->deuda;?></td>
											<td><?php echo $abono->abono;?></td>
											<td><?php echo $abono->saldo;?></td>
											<td scope="col"><a class="btn btn-success" target="_blank" href="?controller=reportea&action=index&codigo_abono=<?php echo $abono->codigo_abono ?>">Ver</a> </th>
										</tr>		
								<?php } ?>

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
