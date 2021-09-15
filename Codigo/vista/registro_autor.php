<?php
require('../controlador/Conexion.php');
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

/////////////////////////////////////////////////////////////////////////////////////////////////////
$stid_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
$r = oci_execute($stid_auditoria);
$row_auditoria = oci_fetch_array($stid_auditoria,OCI_ASSOC); 
session_start();
$user = $_SESSION['user'];

if($row_auditoria == 0){
	$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Registro autor')";
	$stid_aud = oci_parse( $conexion, $query_auditoria );
	oci_execute( $stid_aud );
}else{
	
	$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
	$r2_auditoria = oci_execute($id_nuevo_auditoria);
	while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
		$aux_auditoria = $row_aud['AUD_ID'];
	}
	
	$aux_auditoria = $aux_auditoria+1;
	$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Registro autor')";
	$stid2 = oci_parse( $conexion, $auditoria );
	oci_execute( $stid2 );
}
/////////////////////////////////////////////////////////////////////////////////////////////////////



if ( $ok &&($stid2 || $stid_aud) ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="autores.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');window.history.go(-1);</script>";
}
?>