<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
	protected $email;
	protected $nombre;
	protected $token;

	public function __construct($email, $nombre, $token) {
		$this->email = $email;
		$this->nombre = $nombre;
		$this->token = $token;
	}

	public function enviarConfirmacion() {
		$phpmailer = new PHPMailer();
		$phpmailer->isSMTP();
		$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = 2525;
		$phpmailer->Username = '569626f2581e86';
		$phpmailer->Password = 'cf53632763dc49';

		$phpmailer->setFrom('cuentas@uptask.com','UpTask.com');
		$phpmailer->addAddress($this->email, $this->nombre);
		$phpmailer->Subject = 'Confirma tu Cuenta en UpTask';

		$phpmailer->isHTML(true);
		$phpmailer->CharSet = 'UTF-8';

		$phpmailer->Body = "
		<html>
			<style>
			@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap');
			h2 {
				font-size: 25px;
				font-weight: 500;
				line-height: 25px;
			}
		
			body {
				font-family: 'Poppins', sans-serif;
				background-color: #ffffff;
				max-width: 400px;
				margin: 0 auto;
				padding: 20px;
			}
		
			p {
				line-height: 18px;
			}
		
			a {
				position: relative;
				z-index: 0;
				display: inline-block;
				margin: 20px 0;
			}
		
			a button {
				padding: 0.7em 2em;
				font-size: 16px !important;
				font-weight: 500;
				background: #000000;
				color: #ffffff;
				border: none;
				text-transform: uppercase;
				cursor: pointer;
			}
			p span {
				font-size: 12px;
			}
			div p{
				border-bottom: 1px solid #000000;
				border-top: none;
				margin-top: 40px;
			}
			</style>
			<body>
				<h1>UpTask</h1>
				<h1>" . $this->nombre . "</h1>
				<h2>¡Gracias por registrarte!</h2>
				<p>Por favor confirma tu correo electrónico para que puedas comenzar a disfrutar de todos los servicios de UpTask</p>
				<a href='http://localhost:3000/confirmar?token=" . $this->token . "'><button>Verificar</button></a>
				<p>Si tú no te registraste en UpTask, por favor ignora este correo electrónico.</p>
				<div><p></p></div>
				<p><span>Este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electrónico entrante. Por favor no respondas a este mensaje.</span></p>
			</body>
		</html>";

		$phpmailer->send();
	}

	public function enviarInstrucciones() {
		$phpmailer = new PHPMailer();
		$phpmailer->isSMTP();
		$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = 2525;
		$phpmailer->Username = '569626f2581e86';
		$phpmailer->Password = 'cf53632763dc49';

		$phpmailer->setFrom('cuentas@uptask.com','UpTask.com');
		$phpmailer->addAddress($this->email, $this->nombre);
		$phpmailer->Subject = 'Reestablece tu Contraseña de UpTask';

		$phpmailer->isHTML(true);
		$phpmailer->CharSet = 'UTF-8';

		$phpmailer->Body = "
		<html>
			<style>
			@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap');
			h2 {
				font-size: 25px;
				font-weight: 500;
				line-height: 25px;
			}
		
			body {
				font-family: 'Poppins', sans-serif;
				background-color: #ffffff;
				max-width: 400px;
				margin: 0 auto;
				padding: 20px;
			}
		
			p {
				line-height: 18px;
			}
		
			a {
				position: relative;
				z-index: 0;
				display: inline-block;
				margin: 20px 0;
			}
		
			a button {
				padding: 0.7em 2em;
				font-size: 16px !important;
				font-weight: 500;
				background: #000000;
				color: #ffffff;
				border: none;
				text-transform: uppercase;
				cursor: pointer;
			}
			p span {
				font-size: 12px;
			}
			div p{
				border-bottom: 1px solid #000000;
				border-top: none;
				margin-top: 40px;
			}
			</style>
			<body>
				<h1>UpTask</h1>
				<h1>" . $this->nombre . "</h1>
				<h2>Parece que has olvidado tu contraseña</h2>
				<p>Usa el siguiente boton para volver a disfrutar de todos los servicios de UpTask</p>
				<a href='http://localhost:3000/reestablecer?token=" . $this->token . "'><button>Reestablecer mi contraseña</button></a>
				<p>Si tú no realizaste esta solicitud, por favor ignora este correo electrónico.</p>
				<div><p></p></div>
				<p><span>Este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electrónico entrante. Por favor no respondas a este mensaje.</span></p>
			</body>
		</html>";

		$phpmailer->send();
	}
}