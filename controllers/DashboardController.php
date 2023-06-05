<?php

namespace Controllers;

use Model\Proyecto;
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
		
		// renderizamos la pagina
		$router->render('dashboard/perfil', [
			'titulo' => 'Mi Perfil'
		]);
	}
}