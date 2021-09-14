<?php
$id = $_POST[ 'id' ];
$mat = $_POST['materia'];
$edito = $_POST['editorial'];
$autor = $_POST['autor'];
$titulo = $_POST[ 'nombre' ];
$cantidadDisp=$_POST['cantidadDisp'];
$anioEd=$_POST['anioEd'];
$cantidadPag=$_POST['cantidadPag'];
$formato = $_POST['formato'];
$peso=$_POST['peso'];
$descripcion = $_POST[ 'descripcion' ];
$imagen = $_POST[ 'imagen' ];
$estado = 1;
$conexion = oci_connect( 'BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl' );

$query = "INSERT INTO libro(LIB_ID,MAT_ID,EDI_ID,AUT_ID,LIB_TITULO,LIB_CANTIDADDISPONIBLE,LIB_ANIOEDICION,LIB_CANTIDADPAGINAS,LIB_FORMATO,LIB_PESO,LIB_DESCRIPCION,LIB_PORTADA,LIB_ESTADO) VALUES ($id,$mat,$edito,$autor,'$titulo',$cantidadDisp,'$anioEd',$cantidadPag,'$formato',$peso,'$descripcion','$imagen',$estado)";

$stid = oci_parse( $conexion, $query );
$ok = oci_execute( $stid );

if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_autor.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');window.history.go(-1);</script>";
}
?>