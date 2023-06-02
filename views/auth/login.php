<div class="contenedor login">
	<h1 class="uptask">UpTask</h1>
	<p class="tagline">Crea y Administra tus Proyectos</p>

	<div class="contenedor-sm">
		<p class="descripcion-pagina">Iniciar Sesión</p>

		<form class="formulario" method="POST">
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
				<label for="password">Password</label>
				<input 
					type="password"
					id="password"
					placeholder="Tu Password"
					name="password"
				/>
			</div>
			<input type="submit" class="boton" value="Iniciar Sesión">
			<div class="acciones">
				<a href="/crear-cuenta">¿Aún no tienes una cuenta? <b>Crea una</b></a>
				<a href="/olvide"><i>¿Olvidaste tu Contraseña?</i></a>
			</div>
		</form>
	</div>
</div>