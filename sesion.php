<?php 
session_start();
if (isset($_SESSION['usuario'])) {
	header ('Location: contenido.php');
}

try {
	$conexion = new PDO('mysql:host=localhost;dbname=sesion;charset=utf8',
	'root','');
} catch(PDOException $e) {
	echo 'Error: ' . $e;
}

function limpiardatos($datos) {
	$datos = trim($datos);
	$datos = stripcslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;
}
if (isset($_POST['enviar'])) {
	$usuario = limpiardatos($_POST['usuario']);
	$password = limpiardatos($_POST['password']);
	$statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = 
	:usuario');
	$statement->execute(array(':usuario' => $usuario));
	$resultado = $statement->fetch();
	if ($resultado !== false) {
	$comprobar_passwords = password_verify($password,$resultado['password']);
	if ($comprobar_passwords) {
			$_SESSION['usuario'] = $usuario;
			header ('Location: contenido.php?id=' . $resultado['ID']);
		} 
	} 
}



require 'sesionhtml.php';
?>