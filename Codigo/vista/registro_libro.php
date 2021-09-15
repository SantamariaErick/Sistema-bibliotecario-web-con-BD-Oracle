<?php
require('../controlador/Conexion.php');
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

$prestamo = oci_parse( $conexion, "Select * from LIBRO" );
	$r = oci_execute( $prestamo );
	$row_ini = oci_fetch_array( $prestamo, OCI_ASSOC );
	if ( $row_ini == 0 ) {
		$query = "INSERT INTO libro(LIB_ID,MAT_ID,EDI_ID,AUT_ID,LIB_TITULO,LIB_CANTIDADDISPONIBLE,LIB_ANIOEDICION,LIB_CANTIDADPAGINAS,LIB_FORMATO,LIB_PESO,LIB_DESCRIPCION,LIB_PORTADA,LIB_ESTADO) VALUES (1,$mat,$edito,$autor,'$titulo',$cantidadDisp,'$anioEd',$cantidadPag,'$formato',$peso,'$descripcion','$imagen',$estado)";
		$stid = oci_parse( $conexion, $query );
		oci_execute( $stid );
	} else{
	$id_nuevo = oci_parse($conexion, "Select * from LIBRO");
	$r2 = oci_execute($id_nuevo);
	while ( $row = oci_fetch_array( $id_nuevo ) ) {
		$aux = $row['LIB_ID'];
	}
	
	$aux = $aux+1;
	
	$query = "INSERT INTO libro(LIB_ID,MAT_ID,EDI_ID,AUT_ID,LIB_TITULO,LIB_CANTIDADDISPONIBLE,LIB_ANIOEDICION,LIB_CANTIDADPAGINAS,LIB_FORMATO,LIB_PESO,LIB_DESCRIPCION,LIB_PORTADA,LIB_ESTADO) VALUES ($aux,$mat,$edito,$autor,'$titulo',$cantidadDisp,'$anioEd',$cantidadPag,'$formato',$peso,'$descripcion','$imagen',$estado)";

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
	$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Registro libro')";
	$stid_aud = oci_parse( $conexion, $query_auditoria );
	oci_execute( $stid_aud );
}else{
	
	$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
	$r2_auditoria = oci_execute($id_nuevo_auditoria);
	while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
		$aux_auditoria = $row_aud['AUD_ID'];
	}
	
	$aux_auditoria = $aux_auditoria+1;
	$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Registro libro')";
	$stid2 = oci_parse( $conexion, $auditoria );
	oci_execute( $stid2 );
}
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ( $ok &&($stid2 || $stid_aud) ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_libro.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');window.history.go(-1);</script>";
}
?>