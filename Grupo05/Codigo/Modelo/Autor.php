<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<?php
	require "../controlador/Conexion.php";
	class Autor {

		public function __construct() {}
		
		//Insertar nuevo autor
		public function insertar( $nombre, $descripcion, $urlImagen ) {
			$query = "Insert Into autor (aut_nombre, aut_descripcion, aut_imagen, aut_estado)
		Values ('$nombre','$descripcion','$urlImagen','1')";
			return ejecutarConsulta( $query );
		}
		//Editar autor
		public function editar( $idautor, $nombre, $descripcion, $urlImagen ) {
			$query = "Update autor Set aut_nombre='$nombre',aut_descripcion='$descripcion',aut_imagen='$urlImagen' Where aut_id='$idautor'";
			return ejecutarConsulta( $query );
		}
		//Desactivar autor
		public function desactivar( $idautor ) {
			$query = "Update autor Set aut_estado='0' Where aut_id='$idautor'";
			return ejecutarConsulta( $query );
		}
		//Activar autor
		public function activar( $idautor ) {
			$query = "Update autor Set aut_estado='1' Where aut_id='$idautor'";
			return ejecutarConsulta( $query );
		}
		//Muestra autor
		public function mostrar( $idautor ) {
			$query = "SELECT * FROM autor Where aut_id='$idautor'";
			return ejecutarConsultaSimpleFila( $query );
		}
		//Listar todos los autores
		public function listar() {
			$query = "Select * From autor";
			return ejecutarConsulta( $query );
		}
		//Mostrar autores estado=1
		public function select() {
			$query = "Select * From autor Where aut_estado=1";
			return ejecutarConsulta( $query );
		}
	}
	?>
</body>
</html>