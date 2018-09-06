<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1.0,
maximum-scale=1.0,minimum-scale=1.0"/> 
<title>Sesion</title>
<link rel="stylesheet" type="text/css" href="sesion.css" />
</head>
<body>
<div class="contenedor">
<h2>Tus datos.</h2>
<div class="formulario_datos">
<form enctype="multipart/form-data" 
action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="nombre">Nombre: </label>
	<input type="text" class="nombre_datos" name="nombre" value="<?php
		if ($id !== 0 & $causa == 'editar') {
			echo $resultado['nombre'];
		}
	?>" />
	<label for="primer_apellido">Primer apellido: </label>
	<input type="text" name="primer_apellido" value="<?php
		if ($id !== 0 & $causa == 'editar') {
			echo $resultado['primer_apellido'];
		}
	?>" />
	<label for="segundo_apellido">Segundo apellido: </label>
	<input type="text" name="segundo_apellido" value="<?php
		if ($id !== 0 & $causa == 'editar') {
			echo $resultado['segundo_apellido'];
		}
	?>" />
	<label for="profesion">Profesión: </label>
	<input type="text" name="profesion" value="<?php
		if ($id !== 0 & $causa == 'editar') {
			echo $resultado['profesion'];
		}
	?>" />
	<label for="ciudad">Ciudad: </label>
	<input type="text" name="ciudad" value="<?php
		if ($id !== 0 & $causa == 'editar') {
			echo $resultado['ciudad'];
		}
	?>" />	
	<label for="thumb">Imagen de perfil:</label>
	<input type="file" name="thumb" >
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="causa" value="<?php echo $causa; ?>" />
	<input type="submit" class="enviar_datos" name="enviar_datos" value="Enviar datos" />
</form>
</div>
</div>
</body>
</html>