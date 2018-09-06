<!DOCTYPE html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1.0,
maximum-scale=1.0,minimum-scale=1.0"/> 
<title>Sesion</title>
<link rel="stylesheet" type="text/css" href="sesion.css" />
</head>
<body>
<div class="contenedor">
<div class="perfil"/>
<h3>Perfil</h3><p><a class="cambiar_datos" 
href="datos.php?causa=editar&id=<?php echo $id; ?>" >Cambiar datos.</a></p>
<img class="img_perfil" alt="Imagen de prefil" src="imagenes/<?php 
if ($resultado2['imagen']) {
echo $resultado2['imagen']; 
} else {
	echo 'perfil.png';
} ?>" />
<p>Usuario: <?php echo $resultado['usuario']; ?></p>
<p class="descripcion" >Descripción: <br/>
Mi nombre es <?php echo $resultado2['nombre'] . ' ' . $resultado2['primer_apellido'] .
 ' ' . $resultado2['segundo_apellido']; ?>, soy <?php echo $resultado2['profesion']; ?>
 y vivo en <?php echo $resultado2['ciudad']; ?>. 
</p>
<p><a class="enlace" href="cerrar.php" >Cerrar sesión.</a></p>
</div>
<div class="mensajes">
		<p>Escribe un nuevo mensaje.</p>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="titulo">Título: </label>
		<input type="text" class="titulo" name="titulo" />
		<label for="mensaje">Mensaje: </label>
		<textarea class="textarea" name="mensaje" ></textarea>
		<input type="hidden" name="idfinal" value="<?php echo $id; ?>" />
		<input type="submit" class="enviar" name="enviar_mensaje" 
		value="Enviar mensaje" /> 
	</form>
	<div class="tusmensajes">
		<p>Tus mensajes: </p>
		<?php foreach ($mensajes as $mensaje): ?>
			<div class="mensaje">
				<p><?php echo $mensaje['titulo']; ?></p>
				<p><?php echo $mensaje['mensaje']; ?></p>
			</div>
			<hr/>
		<?php endforeach; ?>
	</div>
</div>
</div>
</body>
</html>