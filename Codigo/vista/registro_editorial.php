<?php
require('../controlador/Conexion.php');
$id = $_POST[ 'id' ];
$nombre = $_POST[ 'nombre' ];
$descripcion = $_POST[ 'descripcion' ];
$estado = 1;

$query = "INSERT INTO editorial(edi_id,edi_nombre, edi_descripcion,edi_estado) VALUES ($id,'$nombre','$descripcion',$estado)";

$stid = oci_parse( $conexion, $query );
$ok = oci_execute( $stid );

if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="editorial.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');window.history.go(-1);</script>";
}
oci_free_statement($stid); 
?>