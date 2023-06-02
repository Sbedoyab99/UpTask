<?php

namespace Controllers;

use MVC\Router;

class LoginController {

	public static function login(Router $router) {

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
		}

		$router->render('auth/login', [
			
		]);
	}

	public static function logout(Router $router) {
		echo 'Desde logout';

		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}
	}

	public static function crear(Router $router) {
		echo 'Desde crear';

		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}
	}

	public static function olvide(Router $router) {
		echo 'Desde olvide';

		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}
	}

	public static function reestablecer(Router $router) {
		echo 'Desde reestablecer';

		if($_SERVER['REQUEST_METHOD'] === 'POST') {

		}
	}

	public static function mensaje(Router $router) {
		echo 'Desde mensaje';

	}

	public static function confirmar(Router $router) {
		echo 'Desde confirmar';

	}

}