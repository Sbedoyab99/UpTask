<?php

namespace Controllers;

use MVC\Router;

class LoginController {

	public static function login(Router $router) {

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
		}

		$router->render('auth/login', [
			'titulo' => 'Iniciar Sesion'
		]);
	}

	public static function logout(Router $router) {
		echo 'Desde logout';

		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}
	}

	public static function crear(Router $router) {
		

		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}

		$router->render('auth/crear', [
			'titulo' => 'Crea una Cuenta'
		]);
	}

	public static function olvide(Router $router) {


		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}

		$router->render('auth/olvide', [
			'titulo' => 'Olvide mi Contraseña'
		]);
	}

	public static function reestablecer(Router $router) {


		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}

		$router->render('auth/reestablecer', [
			'titulo' => 'Reestrablecer Contraseña'
		]);
	}

	public static function mensaje(Router $router) {
		
		$router->render('auth/mensaje', [
			'titulo'=>'Cuenta Creada Correctamente'
		]);
	}

	public static function confirmar(Router $router) {

		$router->render('auth/confirmar', [
			'titulo'=>'Cuenta Confirmada Correctamente'
		]);
	}

}