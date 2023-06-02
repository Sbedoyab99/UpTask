<div class="contenedor crear">
	<?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>	
	<div class="contenedor-sm">
		<p class="descripcion-pagina">Crea tu cuenta en UpTask</p>

		<form class="formulario" method="POST">
			<div class="campo">
				<label for="nombre">Nombre</label>
				<input 
					type="nombre"
					id="nombre"
					placeholder="Tu Nombre"
					name="nombre"
				/>
			</div>
		
			<div class="campo">
				<label for="email">Email</label>
				<input 
					type="email"
					id="email"
					placeholder="Tu Email"
					name="email"
				/>
			</div>

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
			<input type="submit" class="boton" value="Crear Cuenta">
		</form>
		<div class="acciones">
			<a href="/">¿Ya tienes una cuenta? <b>Inicia Sesión</b></a>
			<a href="/olvide"><i>¿Olvidaste tu Contraseña?</i></a>
		</div>
	</div>
</div>