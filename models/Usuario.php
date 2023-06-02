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

	public function ValidarNuevaCuenta() {
		if(!$this->nombre) {
			self::$alertas['error'][] = 'El Nombre es Obligatorio';
		}

		if(!$this->email) {
			self::$alertas['error'][] = 'El Email es obligatorio';
		} else {
			self::$alertas['error'][] = 'Formato de Email no Valido';
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

	public function hashPassword() {
		$this->password = password_hash($this->password, PASSWORD_BCRYPT);
	}

	public function crearToken() {
		$this->token = uniqid();
	}
}