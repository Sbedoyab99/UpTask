<?php

namespace Model;

class Usuario extends ActiveRecord {
	protected static $tabla = 'usuarios';
	protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

	public $id;
	public $nombre;
	public $email;
	public $password;
	public $password2;
	public $password_actual;
	public $password_nuevo;
	public $password_nuevo2;
	public $token;
	public $confirmado;

	public function __construct($args = []) {
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? '';
		$this->email = $args['email'] ?? '';
		$this->password = $args['password'] ?? '';
		$this->password2 = $args['password2'] ?? '';
		$this->token = $args['token'] ?? '';
		$this->confirmado = $args['confirmado'] ?? 0;
	}

	public function validarLogin() {
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			if(!$this->email) {
				self::$alertas['error'][] = 'El Email es obligatorio';
			} else {
				self::$alertas['error'][] = 'Formato de Email no Valido';
			}
		}

		if(strlen($this->password) < 8) {
			if(!$this->password) {
				self::$alertas['error'][] = 'La Contraseña es Obligatoria';
			} else {
				self::$alertas['error'][] = 'La Contraseña debe tener al menos 8 caracteres';
			}
		}
		return self::$alertas;
	}

	public function ValidarNuevaCuenta() {
		if(!$this->nombre) {
			self::$alertas['error'][] = 'El Nombre es Obligatorio';
		}

		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			if(!$this->email) {
				self::$alertas['error'][] = 'Ingresa un Email';
			} else {
				self::$alertas['error'][] = 'Formato de Email no Valido';
			}
		}

		if(strlen($this->password) < 8) {
			if(!$this->password) {
				self::$alertas['error'][] = 'La Contraseña es Obligatoria';
			} else {
				self::$alertas['error'][] = 'La Contraseña debe tener al menos 8 caracteres';
			}
		} else if($this->password !== $this->password2) {
			self::$alertas['error'][] = 'Las contraseñas no coinciden. Inténtalo de nuevo.';
		}
		return self::$alertas;
	}

	public function validarEmail() {
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			if(!$this->email) {
				self::$alertas['error'][] = 'Ingresa un Email';
			} else {
				self::$alertas['error'][] = 'Formato de Email no Valido';
			}
		}
		return self::$alertas;
	}

	public function validarPassword() {
		if(strlen($this->password) < 8) {
			if(!$this->password) {
				self::$alertas['error'][] = 'La Contraseña es Obligatoria';
			} else {
				self::$alertas['error'][] = 'La Contraseña debe tener al menos 8 caracteres';
			}
		} else if($this->password !== $this->password2) {
			self::$alertas['error'][] = 'Las contraseñas no coinciden. Inténtalo de nuevo.';
		}
		return self::$alertas;
	}

	public function validarPerfil() {
		if(!$this->nombre) {
			self::$alertas['error'][] = 'El Nombre es Obligatorio';
		}

		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			if(!$this->email) {
				self::$alertas['error'][] = 'Ingresa un Email';
			} else {
				self::$alertas['error'][] = 'Formato de Email no Valido';
			}
		}
		return self::$alertas;
	}

	public function nuevo_password() {
		if(!$this->password_actual) {
			self::$alertas['error'][] = 'La Contraseña actual no puede ir vacia';
		}
		
		if(strlen($this->password_nuevo) < 8) {
			if(!$this->password_nuevo) {
				self::$alertas['error'][] = 'La Contraseña nueva no puede ir vacia';
			} else {
				self::$alertas['error'][] = 'La nueva contraseña debe contener al menos 8 caracteres';
			}
		} else if(($this->password_nuevo !== $this->password_nuevo2)) {
			if(!$this->password_nuevo2) {
				self::$alertas['error'][] = 'Debes repetir la nueva contraseña';
			} else {
				self::$alertas['error'][] = 'Las Contraseñas no coinciden';
			}
		}
		return self::$alertas;
	}

	public function comprobarPassword() {
		return password_verify($this->password_actual, $this->password);
	}

	public function hashPassword() {
		$this->password = password_hash($this->password, PASSWORD_BCRYPT);
	}

	public function crearToken() {
		$this->token = uniqid();
	}
}