<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController {
	public static function index() {
		// Inicio la Sesion
		session_start();
		// Recupero el id del proyecto (url)
		$url = $_GET['id'];
		// Si no hay id: Redirecciono
		if(!$url) header('location: /dashboard');
		// Recupero el proyecto con la url
		$proyecto = Proyecto::where('url', $url);
		// Si no se encuentra un proyecto con esa url
		// o el usuario no tiene permisos: Redirecciono
		if(!$proyecto || $proyecto->propietarioid !== $_SESSION['id']) header('location: /404');
		// Busco las tareas relacionadas a ese proyecto
		$tareas = Tarea::belongsTo('proyectoid', $proyecto->id);
		// Convierto las tareas a json (objeto php -> json)
		echo json_encode(['tareas' => $tareas]);
	}
	public static function crear() {
		// Inicio la sesion
		session_start();
		// Si el estado del servidor es POST
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
					'id' => $resultado['id'],
					'proyectoid' => $proyecto->id
				];
				echo json_encode($respuesta);
			}
		}
	}
	public static function actualizar() {
		// Inicio Sesion
		session_start();
		// El servidor solo recibe post
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Validar que el proyecto existe
			$proyecto = Proyecto::where('url', $_POST['url']);
			// Si no hay un proyecto o el usuario no puede modificar el proyecto:
			if(!$proyecto || $proyecto->propietarioid !== $_SESSION['id']) {
				$respuesta = [
					'tipo' => 'error',
					'mensaje' => 'Hubo un error al actualizar la tarea'
				];
				echo json_encode($respuesta);
			// Si todo esta bien
			} else {
				// Creo una nueva instancia de tarea con los datos de $_POST
				$tarea = new Tarea($_POST);
				$tarea->proyectoid = $proyecto->id;
				// Guardo la tarea en la base de datos
				$resultado = $tarea->guardar();
				// Si se guarda correctamente:
				if($resultado) {
					$respuesta = [
						'tarea' => $tarea,
						'tipo' => 'exito',
						'proyectoid' =>$proyecto->id,
						'id' => $tarea->id,
						'mensaje' => 'Actualizado correctamente'
					];
					echo json_encode(['respuesta' => $respuesta]);
				}
			}
		}
	}
	public static function eliminar() {
		// Inicio Sesion
		session_start();
		// El servidor solo recibe post
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Validar que el proyecto existe
			$proyecto = Proyecto::where('url', $_POST['url']);
			// Si no hay un proyecto o el usuario no puede modificar el proyecto:
			if(!$proyecto || $proyecto->propietarioid !== $_SESSION['id']) {
				$respuesta = [
					'tipo' => 'error',
					'mensaje' => 'Hubo un error al eliminar la tarea'
				];
				echo json_encode($respuesta);
			// Si todo esta bien
			} else {
				// Creo una nueva instancia de tarea con los datos de $_POST
				$tarea = new Tarea($_POST);
				$tarea->proyectoid = $proyecto->id;
				// Guardo la tarea en la base de datos
				$resultado = $tarea->eliminar();
				// Si se guarda correctamente:
				if($resultado) {
					$respuesta = [
						'tipo' => 'exito',
						'mensaje' => 'Eliminado correctamente',
						'resultado' => $resultado
					];
					echo json_encode($respuesta);
				}
			}
		}
	}
}

