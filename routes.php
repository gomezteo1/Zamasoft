<?php
	//función que llama al controlador y su respectiva acción, que son pasados como parámetros
	function call($controller, $action){
		//importa el controlador desde la carpeta Controllers
		require_once('Controladores/' . $controller . '_Controlador.php');
		//crea el controlador
		switch($controller){
			case 'usuario':
	 			require_once('Modelos/Usuario.php');
	 			$controller = new Usuario_Controlador();
 				break;
			case 'rol':
				require_once('Modelos/Rol.php');
				$controller= new Rol_Controlador();
				break;
			case 'tipo_documento':
				require_once('Modelos/Tipo_Documento.php');
				$controller= new Tipo_Documento_Controlador();
				break;	 	
			case 'cuenta_cobro':
				require_once('Modelos/Cuenta_cobro.php');
				$controller=new Cuenta_cobro_Controlador();
				break;
			case 'pago':
				require_once('Modelos/Pago.php');
				$controller=new Pago_Controlador();
				break;
			case 'inmueble':
				require_once('Modelos/Inmueble.php');
				$controller=new Inmueble_Controlador();
				break;
			case 'tipo_pago':
				 require_once('Modelos/Tipo_Pago.php');
				 $controller=new Tipo_Pago_Controlador();
				 break; 
			case 'abono':
				 require_once('Modelos/Abono.php');
				 $controller= new Abono_Controlador();
				 break;
			case 'reporte':
				$controller= new Reporte_Controlador();
				break;
			case 'reportea':
				$controller= new ReporteA_Controlador();
				break;
			case 'reportec':
				$controller= new ReporteC_Controlador();
				break; 		 	 
			case 'mora':
				 require_once('Modelos/Mora.php');
				 $controller= new Mora_Controlador();
				 break;
			case 'month':
				 require_once('Modelos/Month.php');
				 $controller= new Month_Controlador();
				 break;	
			case 'usuario_inmueble':
				 require_once('Modelos/Usuario_Inmueble.php');
				 $controller= new Usuario_Inmueble_Controlador();
				 break;	 		  	
	 
		}
		//llama a la acción del controlador
		$controller->{$action }();
	}

if(isset($_SESSION['acceso']) &&  $_SESSION['acceso']['id_rol']==1){
	//array con los controladores y sus respectivas acciones
	$controllers= array(
		'usuario' => ['landing','index','indexUsuario','indexUsuario','frm_registrar_usuario','frm_modificar_administrador','frm_login','frm_singup','eliminar_administrador','cerrarSesion','desactivar_estado_usuario','activar_estado_usuario','frm_sweet','frm_cambiarClaveAdm','frm_cambiarClaveUsu'],
		'rol'=>['index','formulario_registrar','formulario_modificar','registrar','modificar','eliminar_rol','eliminar','cambiar_estado_rol'],
		'tipo_documento'=>['index','formulario_registrar','formulario_modificar','registrar','modificar','eliminar_tipo_documento','eliminar'],
		'cuenta_cobro'=>['index','formulario_cuenta_cobro','formulario_editar','eliminar_cuenta_cobro'],
		'pago'=>['index','formulario_registrar','formulario_modificar','eliminar_pago'],
		'inmueble'=>['index','formulario_registrar','formulario_modificar','registrar','modificar','eliminar_inmueble','eliminar'],
		'tipo_pago'=>['index','formulario_registrar','formulario_modificar','eliminar_tipo_pago'],
		'abono'=>['index','formulario_registrar','formulario_modificar','registrar','modificar','eliminar_abono','eliminar'],
		'reporte'=>['index'],'reportea'=>['index'],'reportec'=>['index'],
		'mora'=>['index','formulario_registrar','formulario_modificar','eliminar_mora'],
		'month'=>['index','formulario_registrar','formulario_modificar','eliminar_month'],
		'usuario_inmueble'=>['index','formulario_registrar','formulario_modificar','eliminar_usuario_inmueble']

		);
	}
	else if(isset($_SESSION['acceso']) && $_SESSION['acceso']['id_rol']==2){$controllers= array(
						'cuenta_cobro'=>['indexusuario'],
						'pago'=>['indexusuario'],
						'abono'=>['indexusuario'],
						'usuario_inmueble'=>['indexusuario'],
						'usuario' => ['frm_cambiarClaveUsu','landing','indexUsuario','frm_modificar_usuario','eliminar_usuario','cerrarSesion','cambiarClaveUsu']);
	}
	else if(isset($_SESSION['acceso']) && $_SESSION['acceso']['id_rol']==3){$controllers= array(
						'usuario' => ['frm_cambiarClaveUsu','landing','indexUsuario','frm_modificar_usuario','eliminar_usuario','cerrarSesion']);
	}
	else {$controllers= array(
				'usuario' => ['landing','frm_registrar_usuario','frm_login','frm_recuperar_clave']);
	}	
	//verifica que el controlador enviado desde index.php esté dentro del arreglo controllers
	if(isset($controller))
	{
		if (array_key_exists($controller, $controllers)) {
			//verifica que el arreglo controllers con la clave que es la variable controller del index exista la acción
			if (in_array($action, $controllers[$controller])) {
				//llama  la función call y le pasa el controlador a llamar y la acción (método) que está dentro del controlador
				call($controller, $action);
			}else{
				call('usuario', 'error');
			}
		}else{// le pasa el nombre del controlador y la pagina de error
			//call('usuario', 'error');
		}
	}
	else{ 
			//call('usuario', 'error');

	}
?>