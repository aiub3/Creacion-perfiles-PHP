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
<h2>Registro.</h2>
<div class="formulario">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="usuario">Usuario: </label>
	<input type="text" class="nombre" name="usuario" />
	<label for="password">Contraseña: </label>
	<input type="password" class="password" name="password" />
	<label for="password">Repetir contraseña: </label>
	<input type="password" class="password2" name="password2" />
	<input type="submit" class="enviar" name="enviar" value="Enviar" />
</form>
</div>
<p class="existe_cuenta" >¿Ya tienes cuenta?<br/>
<a href="sesion.php" >Iniciar sesión.</a></p>
</div>
</body>
</html>