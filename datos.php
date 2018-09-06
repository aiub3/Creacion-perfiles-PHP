<?php 
session_start();

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
if (isset($_SESSION['usuario'])) {
	$id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
	$causa = (isset($_GET['causa'])) ?  limpiardatos($_GET['causa']) : 0;
	if ($id !== 0 & $causa !== 0) { 	} else {
		echo 'causa e id tienen que tener valor en la url';
	}
	$statement = $conexion->prepare('SELECT * FROM datos WHERE ID = :id');
	$statement->execute(array(':id' => $id));
	$resultado = $statement->fetch();
if (isset($_POST['enviar_datos'])) {
	$idfinal = $_POST['id'];
	$causafinal = $_POST['causa'];
	$nombre = limpiardatos($_POST['nombre']);
	$primer_apellido = limpiardatos($_POST['primer_apellido']);
	$segundo_apellido = limpiardatos($_POST['segundo_apellido']);
	$profesion = limpiardatos($_POST['profesion']);
	$ciudad = limpiardatos($_POST['ciudad']);
	$imagen = $_FILES['thumb']['name'];
	if ($causafinal == 'editar') {
		$statement = $conexion->prepare('
	UPDATE datos SET nombre = :nombre, primer_apellido = :primer_apellido, 
	segundo_apellido = :segundo_apellido, profesion = :profesion, ciudad = 
	:ciudad, imagen = :imagen WHERE ID = :id');
	$statement->execute(array(
		':nombre' => $nombre,
		':primer_apellido' => $primer_apellido,
		':segundo_apellido' => $segundo_apellido,
		':profesion' => $profesion,
		':ciudad' => $ciudad,
		':imagen' => $imagen,
		':id' => $idfinal
	));
		header ('Location: contenido.php?id=' . $idfinal);
	} else if ($causafinal == 'crear') {
	$statement = $conexion->prepare('INSERT INTO datos (ID, nombre, primer_apellido,
	segundo_apellido, profesion, ciudad, imagen) VALUES (:id, :nombre, :primer_apellido, 
	:segundo_apellido, :profesion, :ciudad, :imagen)');
	$statement->execute(array(':id' => $idfinal, ':nombre' => $nombre, ':primer_apellido' => 
	$primer_apellido, ':segundo_apellido' => $segundo_apellido, ':profesion' => 
	$profesion, ':ciudad' => $ciudad, ':imagen' => $imagen));
	header ('Location: contenido.php?id=' . $idfinal);
	} else {
		echo 'editar tiene un valor incorrecto';
	}
}
} else {
	header ('sesion.php');
}


require 'datoshtml.php';
?>