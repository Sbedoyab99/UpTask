<?php include_once __DIR__ . '/header-dashboard.php' ?>
	<div class="contenedor-sm">
		<?php include_once __DIR__ . '/../templates/alertas.php'?>
		<a href="/perfil" class="enlace">Cancelar</a>
		<form class="formulario" method="POST" novalidate>
			<div class="campo">
				<label for="password_actual">Contraseña Actual</label>
				<input 
					type="password"
					name="password_actual"
					placeholder="Tu Contraseña Actual">
			</div>
			<div class="campo">
				<label for="password_nuevo">Nueva Contraseña</label>
				<input 
					type="password"
					name="password_nuevo"
					placeholder="Tu Nueva Contraseña">
			</div>
			<div class="campo">
				<label for="password_nuevo2">Repite tu Nueva Contraseña</label>
				<input 
					type="password"
					name="password_nuevo2"
					placeholder="Repite tu Nueva Contraseña">
			</div>
			<input type="submit" value="Cambiar Contraseña">
		</form>
	</div>
<?php include_once __DIR__ . '/footer-dashboard.php' ?>