<?php
$id = $_POST[ 'id' ];
$nombre = $_POST[ 'nombre' ];
$descripcion = $_POST[ 'descripcion' ];
$imagen = $_POST[ 'imagen' ];
$estado = 1;

$conexion = oci_connect( 'BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl' );

$query = "INSERT INTO autor(aut_id,aut_nombre, aut_descripcion,aut_imagen,aut_estado) VALUES ($id,'$nombre','$descripcion','$imagen',$estado)";

$stid = oci_parse( $conexion, $query );
$ok = oci_execute( $stid );

if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_autor.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');window.history.go(-1);</script>";
}
?>