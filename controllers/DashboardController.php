<?php

namespace Controllers;

use MVC\Router;

class DashboardController {
	public static function index(Router $router) {
		// Iniciamos una sesion
		session_start();
		// Verificamos que el usuario este autenticado
		isAuth();

		// Renderizamos la pagina
		$router->render('dashboard/index', [
			'titulo' => 'Proyectos'
		]);
	}

	public static function crear(Router $router) {
		// Iniciamos una sesion
		session_start();
		
		// renderizamos la pagina
		$router->render('dashboard/crear-proyecto', [
			'titulo' => 'Crear Proyecto'
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