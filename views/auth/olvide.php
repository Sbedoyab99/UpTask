<div class="contenedor olvide">
	<?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>
	<div class="contenedor-sm">
		<p class="descripcion-pagina">Recupera tu Acceso a UpTask</p>

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

			<input type="submit" class="boton" value="Enviar Instrucciones">
		</form>
		<div class="acciones">
			<a href="/">¿Ya tienes una cuenta? <b>Inicia Sesión</b></a>
			<a href="/crear">¿Aún no tienes una cuenta? <b>Crea una</b></a>
		</div>
	</div>
</div>