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
	$datos = strtolower($datos);
	return $datos;
}
if (isset($_POST['enviar'])) {
	$usuario = limpiardatos($_POST['usuario']);
	$password = limpiardatos($_POST['password']);
	$passHash = password_hash($password, PASSWORD_BCRYPT);
	$password2 = limpiardatos($_POST['password2']);
	$passHash2 = password_hash($password2, PASSWORD_BCRYPT);
	if (!empty($usuario) or !empty($password) or !empty($password2)) {
		$statement = $conexion->prepare('SELECT * FROM usuarios WHERE 
		usuario = :usuario LIMIT 1');
		$statement->execute(array(':usuario' => $usuario));
		$resultado = $statement->fetch();
		if ($resultado === false) {
	if ($password == $password2) {
		$statement2 = $conexion->prepare('INSERT INTO usuarios
		(ID, usuario, password) VALUES (null, :usuario, :password)');
		$statement2->execute(array(':usuario' => $usuario, ':password' => $passHash));
		$_SESSION['usuario'] = $usuario;
		$statement3 = $conexion->prepare('SELECT * FROM usuarios WHERE 
		usuario = :usuario LIMIT 1');
		$statement3->execute(array(':usuario' => $usuario));
		$resultado = $statement3->fetch();
		$id = $resultado['ID'];
		print_r($resultado);
		echo $id; 
		if (isset($id)) {
		header ('Location: datos.php?causa=crear&id=' . $id);
		} else {
			echo 'no existe';
		}
	} else {
		echo 'Las contraseñas no coinciden.';
	}
		} else {
			echo 'El nombre de usuario ya existe';
		}
	} else {
		echo 'Completa los datos correctamente';
	}
}


require 'registrohtml.php';
?>