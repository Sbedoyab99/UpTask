<?php include_once __DIR__ . '/header-dashboard.php' ?>
<?php if(count($proyectos) === 0){ ?>
		<div class="no-proyectos">
			<p> Parece Que Aún No Tienes Ningún Proyecto. </p>
			<p> Comienza Creando Uno!</p>
			<a href="/crear-proyecto">Crear Proyecto</a>
		</div>
<?php } else {?>
		<ul class="listado-proyectos">
			<?php foreach($proyectos as $proyecto) { ?>
					<li>
						<a class="proyecto" href="/proyecto?id=<?php echo $proyecto->url ?>">
							<?php echo $proyecto->proyecto ?>
						</a>
					</li>
			<?php } ?>
		</ul>
<?php } ?>
<?php include_once __DIR__ . '/footer-dashboard.php' ?>