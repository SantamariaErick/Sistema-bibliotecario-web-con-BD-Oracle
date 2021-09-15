<?php
$id = $_POST[ 'id' ];
$nombre = $_POST[ 'nombre' ];
$descripcion = $_POST[ 'descripcion' ];
$imagen = $_POST[ 'imagen' ];
$estado = 1;

$conexion = oci_connect( 'BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl' );


$autor = oci_parse($conexion, "Select * from AUTOR");
$r = oci_execute($autor);
$row_ini = oci_fetch_array($autor,OCI_ASSOC);

if($row_ini == 0){
	$query =  "INSERT INTO autor(aut_id,aut_nombre, aut_descripcion,aut_imagen,aut_estado) VALUES (1,'$nombre','$descripcion','$imagen',$estado)";
	
	$stid = oci_parse( $conexion, $query );
	oci_execute( $stid );
}else{
	
	$id_nuevo = oci_parse($conexion, "Select * from AUTOR");
	$r2 = oci_execute($id_nuevo);
	while ( $row = oci_fetch_array( $id_nuevo ) ) {
		$aux = $row['AUT_ID'];
	}
	
	$aux = $aux+1;
	
	$query = "INSERT INTO autor(aut_id,aut_nombre, aut_descripcion,aut_imagen,aut_estado) VALUES ($aux,'$nombre','$descripcion','$imagen',$estado)";

	$stid = oci_parse( $conexion, $query );
	$ok = oci_execute( $stid );

}

if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="autor.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');window.history.go(-1);</script>";
}
?>