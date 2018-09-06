<?php 
session_start();
if (isset($_SESSION['usuario'])) {
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

$id = (isset($_GET['id'])) ? (int)$_GET['id'] : 1;

$statement = $conexion->prepare('SELECT * FROM usuarios WHERE ID = :id 
LIMIT 1');
$statement->execute(array(':id' => $id));
$resultado = $statement->fetch();

$statement2 = $conexion->prepare('SELECT * FROM datos WHERE ID = :id 
LIMIT 1');
$statement2->execute(array(':id' => $id));
$resultado2 = $statement2->fetch();

if (isset($_POST['enviar_mensaje'])) {
	$idfinal = $_POST['idfinal'];
	$titulo = (isset($_POST['titulo'])) ? limpiardatos($_POST['titulo']) : 
	'Título';
	$mensaje = (isset($_POST['mensaje'])) ? limpiardatos($_POST['mensaje']) : 
	'Mensaje';
	$statement3 = $conexion->prepare('INSERT INTO mensajes (ID2, titulo, mensaje) 
	VALUES (:id, :titulo, :mensaje)');
	$statement3->execute(array(':id' => $idfinal, ':titulo' => $titulo, 
	':mensaje' => $mensaje));
	header ('Location: contenido.php?id=' . $idfinal);
}

$statement4 = $conexion->prepare('SELECT * FROM mensajes WHERE ID2 =:id');
$statement4->execute(array(':id' => $id));
$mensajes = $statement4->fetchAll();

require 'contenidohtml.php';
} else {
	header ('Location: sesion.php');
}
?>