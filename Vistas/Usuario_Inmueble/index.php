<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Inicio Usuario Inmueble</title>
	<!-- Esto es del toogle-->
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script
	  src="https://code.jquery.com/jquery-3.4.1.js"
	  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	  crossorigin="anonymous"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
	<div align="center">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-shopping-cart"></i>
			</div>
			<div align="left" class="full-width header-well-text">
				<p class="text-condensedLight">
				Inmueble y su Usuario
				<a class="btn btn-outline-primary" href="?controller=usuario_inmueble&action=formulario_registrar">Registrar</a>

				</p>
				<input type="text" name="txtbuscar" id="txtbuscar" />
				<button class="btn-outline" name="btnbuscar" id="btnbuscar">
					<img src="./Reportes/imajenes/busqueda.png">
				</button>
			</div>
		</section>
		<div class=""></div>
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
				<div id="resultado_busqueda">
					<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
						<thead>
							<tr>
								<td><b>#Usuario Inmueble</b></td>
								<td><b>Usuario</b></td>
								<td><b>Inmueble</b></td>
								<td colspan=2><b>Acciones</b></td>
							</tr>		
						</thead>
						<?php foreach ($usuario_inmuebles as $usuario_inmueble) { ?>
						<tbody>
							<tr>
								<td><?php echo $usuario_inmueble->id_usuario_inmueble; ?></td>
								<td><?php echo $usuario_inmueble->nombreUsuario; ?></td>
								<td><?php echo $usuario_inmueble->nombreInmueble;?></td>
								<td><a class="btn btn-secondary" href="?controller=usuario_inmueble&action=formulario_modificar&id_usuario_inmueble=<?php echo $usuario_inmueble->id_usuario_inmueble ?>">Actualizar</a></td>
								<!-- <td><a class="btn btn-danger"  href="?controller=usuario_inmueble&action=eliminar_usuario_inmueble&id_usuario_inmueble=<?php echo $usuario_inmueble->id_usuario_inmueble?>">E</a> </th> -->
								<!--<td><a class="btn btn-success" target="_blank" href="?controller=reporte&action=index&codigo_pago=<?php echo $usuario_inmueble->id_usuario_inmueble ?>">Ver</a> </th>-->
							</tr>
						</tbody>
						<?php }	?>
						<tfoot>
							<tr>
								<td><b>#Usuario Inmueble</b></td>
								<td><b>Usuario</b></td>
								<td><b>Inmueble</b></td>
								<td colspan=2><b>Acciones</b></td>
							</tr>		
						</tfoot>
					</table>
				</div>
			</div>
		</div>		
	</div>
</body>

<!--este es del toogle-->
<!--este es del toogle-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<script>
$(function(){ //Función Jquery
  	$('#btnbuscar').click(function(e) {
    e.preventDefault(); //Evitar submit
	metodo="Buscar";
	dato_buscar=document.getElementById('txtbuscar').value;
	alert(dato_buscar);
	 $.ajax({
			type:'POST',
          	url:'Controladores/Usuario_Inmueble_Controlador.php',
           	data:{action:metodo,dato_buscar:dato_buscar},
            success:function(data){	
				document.getElementById('resultado_busqueda').innerHTML=data;				
			}
		});	
	});		
});

</script>
</html>


