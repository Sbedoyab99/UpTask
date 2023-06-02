<?php

namespace Controllers;

use Model\Usuario;
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
		// Creamos una nueva instancia de usuario vacia
		$usuario = new Usuario;
		$alertas = [];

		// Cuando se envia el formulario:
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Sincronizamos la instancia de usuario con la info. del form.
			$usuario->sincronizar($_POST);
			// Validamos que la informacion del formulario sea correcta
			$alertas = $usuario->validarNuevaCuenta();
			// Si la informacion del formulario es correcta:
			if(empty($alertas)) {
				// Verificamos si existe un usuario con el mismo correo
				$existeUsuario = Usuario::where('email', $usuario->email);
				// Si el correo ya esta en uso:
				if($existeUsuario) {
					// Enviamos una alerta de error 
					Usuario::setAlerta('error', 'Ese correo ya esta en uso. Prueba con otro.');
					$alertas = Usuario::getAlertas();
				// Si el correo esta disponible:
				} else {
					// Hasheamos la contraseña suministrada
					$usuario->hashPassword();
					// Eliminamos el atributo 'password2' de el objeto usuario
					unset($usuario->password2);
					// Generamos el token para la confirmacion de la cuenta
					$usuario->crearToken();
					// Creamos el usuario
					$resultado = $usuario->guardar();
					// Si se crea el usuario correctamente:
					if($resultado) {
						// Redireccionamos a la pagina de mensaje
						header('location: /mensaje');
					}
				}
			}
		}

		$router->render('auth/crear', [
			'titulo' => 'Crea una Cuenta',
			'usuario' => $usuario,
			'alertas' => $alertas
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