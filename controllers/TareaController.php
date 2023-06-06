<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController {
	public static function index() {
		
	}
	public static function crear() {
		// Inicio la sesion
		session_start();
		// Si el estado del serividor es POST
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Recupero el proyecto con la informacion de $_POST
			$proyecto = Proyecto::where('url', $_POST['url']);
			// Si no hay un proyecto o el usuario no puede modificar el proyecto:
			if(!$proyecto || $proyecto->propietarioid !== $_SESSION['id']) {
				$respuesta = [
					'tipo' => 'error',
					'mensaje' => 'Hubo un error al agregar la tarea'
				];
				echo json_encode($respuesta);
			// Si todo esta bien
			} else {
				// Creo una nueva instancia de tarea con los datos de $_POST
				$tarea = new Tarea($_POST);
				$tarea->proyectoid = $proyecto->id;
				// Guardo la tarea en la base de datos
				$resultado = $tarea->guardar();
				$respuesta = [
					'tipo' => 'exito',
					'mensaje' => 'Tarea Creada Correctamente',
					'id' => $resultado['id']
				];
				echo json_encode($respuesta);
			}
		}
	}
	public static function actualizar() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
		}
	}
	public static function eliminar() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
		}
	}
}