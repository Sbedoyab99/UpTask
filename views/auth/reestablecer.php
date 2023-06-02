<div class="contenedor reestablecer">
	<?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>
	<div class="contenedor-sm">
		<p class="descripcion-pagina">Ingresa tu Nueva Contraseña</p>

		<form class="formulario" method="POST">
			<div class="campo">
				<label for="password">Contraseña</label>
				<input 
					type="password"
					id="password"
					placeholder="Tu Contraseña"
					name="password"
				/>
			</div>

			<div class="campo">
				<label for="password2">Repite tu Contraseña</label>
				<input 
					type="password"
					id="password2"
					placeholder="Repite tu Contraseña"
					name="password2"
				/>
			</div>
			<input type="submit" class="boton" value="Actualizar Contraseña">
		</form>
		<div class="acciones">
			<a href="/">¿Ya tienes una cuenta? <b>Inicia Sesión</b></a>
			<a href="/crear">¿Aún no tienes una cuenta? <b>Crea una</b></a>
		</div>
	</div>
</div>