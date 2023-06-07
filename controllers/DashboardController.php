<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController {
	public static function index(Router $router) {
		// Iniciamos una sesion
		session_start();
		// Verificamos que el usuario este autenticado
		isAuth();
		// Recupero el id de la sesion
		$id = $_SESSION['id'];
		// Recupero los proyectos que este usuario ha creado
		$proyectos = Proyecto::belongsTo('propietarioid', $id);
		// Renderizamos la pagina
		$router->render('dashboard/index', [
			'titulo' => 'Proyectos',
			'proyectos' => $proyectos
		]);
	}

	public static function crear(Router $router) {
		$alertas = [];
		// Iniciamos una sesion
		session_start();
		// Verificamos que haya una session autenticada
		isAuth();
		// Si se oprime el boton Crear Proyecto:
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Creamos una nueva instancia de proyecto con la informacion de $_POST
			$proyecto = new Proyecto($_POST);
			// Validamos que todos los campos esten completos
			$alertas = $proyecto->validarProyecto();
			// Si no hay alertas:
			if(empty($alertas)) {
				// Genero una url unica para el proyecto
				$proyecto->url = md5(uniqid());
				// Recuperar el usuario creador del proyecto
				$proyecto->propietarioid = $_SESSION['id'];
				// Guardamos el proyecto en la base de datos
				$resultado = $proyecto->guardar();
				// Si se creo correctamente:
				if($resultado) {
					// Redireccionamos a la vista del nuevo proyecto
					header('location: /proyecto?id=' . $proyecto->url);
				// Si el proyecto no se creo
				} else {
					// Enviamos una alerta
					Proyecto::setAlerta('error', 'Ha ocurrido un error. Intentalo mas tarde.');
				}
			}
		}
		// Recuperamos las alertas
		$alertas = Proyecto::getAlertas();
		// renderizamos la pagina
		$router->render('dashboard/crear-proyecto', [
			'titulo' => 'Crear Proyecto',
			'alertas' => $alertas
		]);
	}

	public static function proyecto(Router $router) {
		// Iniciamos una sesion
		session_start();
		// Verificamos que haya una session autenticada
		isAuth();
		/** Solo la persona que creo el proyecto puede ingresar a esta pagina */
		// Recupero la url de identificacion del proyecto
		$token = $_GET['id'];
		// Si no hay token redirecciono a la pagina principal
		if(!$token) header('location: /dashboard');
		// Recupero la informacion del proyecto
		$proyecto = Proyecto::where('url', $token);
		// Comparo el id del proyecto recuperado y el id de la sesion, si es diferente redirecciono
		if($proyecto->propietarioid !== $_SESSION['id']) header('location: /dashboard');
		// Renderizamos la pagina
		$router->render('dashboard/proyecto', [
			'titulo' => $proyecto->proyecto
		]);
	}

	public static function perfil(Router $router) {
		// Iniciamos una sesion
		session_start();
		$alertas = [];
		// Verificamos que esta autenticado
		isAuth();
		// Creo la instancia de usuario con el id d ela session
		$usuario = Usuario::find($_SESSION['id']);
		// Si se modifican datos:
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			// Sincronizo el usuario con los datos enviados a POST
			$usuario->sincronizar($_POST);
			// Valido que la informacion sea correcta
			$alertas = $usuario->validarPerfil();
			// Si no hay alertas:
			if(empty($alertas)) {
				// Verificamos si existe un usuario con el mismo correo
				$existeUsuario = Usuario::where('email', $usuario->email);
				// Si el correo ya esta en uso:
				if($existeUsuario && $existeUsuario->id !== $usuario->id) {
					// Enviamos una alerta de error 
					Usuario::setAlerta('error', 'Ese correo ya esta en uso. Prueba con otro.');
				// Si el correo esta disponible:	
				} else {
					// Actualizo el usuario
					$usuario->guardar();
					// Envio una alerta de exito
					Usuario::setAlerta('exito', 'Cambios Aplicados Correctamente');
					// Actualizamos los datos de la sesion
					$_SESSION['nombre'] = $usuario->nombre;
					$_SESSION['email'] = $usuario->email;
				}
			}
			// Recuperamos las alertas
			$alertas = Usuario::getAlertas();
		}	
		// renderizamos la pagina
		$router->render('dashboard/perfil', [
			'titulo' => 'Mi Perfil',
			'usuario' => $usuario,
			'alertas' => $alertas
		]);
	}

	public static function cambiar_password(Router $router) {
		// Iniciamos la sesion
		session_start();
		$alertas = [];
		// Verificamos que esta autenticado
		isAuth();
		// Si se oprime en cambiar contraseña:
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			// creamos una instancia de usuario con el id de la sesion
			$usuario = Usuario::find($_SESSION['id']);
			// Sincronizamos el objeto
			$usuario->sincronizar($_POST);
			// Validamos que la informaciond el formulario este correcta
			$alertas = $usuario->nuevo_password();
			// Si no hay alertas
			if(empty($alertas)) {
				// Comprobamos que el password actual sea correcto
				$resultado = $usuario->comprobarPassword();
				// Si no es correcto:
				if(!$resultado) {
					// Enviamos una alerta
					Usuario::setAlerta('error', 'Contraseña incorrecta');
				// Si es correcto:	
				}	else {
					// Si la nueva contraseña es igual a la anterior:
					if ($usuario->password_nuevo === $usuario->password_actual) {
						$alertas = Usuario::setAlerta('error', 'Tu nueva contraseña no puede ser igual a la anterior');
					// Si son diferentes:	
					} else {
						// Asiganmos el nuevo password
						$usuario->password = $usuario->password_nuevo;
						// Eliminamos propiedades innecesarias
						unset($usuario->password_actual);
						unset($usuario->password_nuevo);
						unset($usuario->password_nuevo2);
						// hasheamos el nuevo password
						$usuario->hashPassword();
						// Actualizamos la informacion del usuario
						$resultado = $usuario->guardar();
						// Si se cambio satisfatoriamente:
						if($resultado) {
							Usuario::setAlerta('exito', 'Contraseña Actualizada Correctamente');
						}
					}	
				}
			}
			$alertas = Usuario::getAlertas();
		}
		// Renderizamos la pagina
		$router->render('dashboard/cambiar-password', [
			'titulo' => 'Cambiar Contraseña',
			'alertas' => $alertas
		]);
	}
}