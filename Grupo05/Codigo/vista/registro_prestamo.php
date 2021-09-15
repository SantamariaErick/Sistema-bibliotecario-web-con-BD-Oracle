<?php
require('../controlador/Conexion.php');
$est = $_POST['estudiante'];
$libro = $_POST['libro'];
$fpresta = $_POST['fpresta'];
$fdevol = $_POST[ 'fdevol' ];
$cantidad=$_POST['cantidad'];
$observacion=$_POST['observacion'];
$condicion = $_POST['condicion'];


$prestamo = oci_parse($conexion, "Select * from PRESTAMO");
$r = oci_execute($prestamo);
$row_ini = oci_fetch_array($prestamo,OCI_ASSOC);

if($row_ini == 0){
	$query =  "INSERT INTO prestamo(PRE_ID,EST_ID, LIB_ID,PRE_FECHAPRESTADO,PRE_FECHADEVUELTO,PRE_CANTIDAD,PRE_OBSERVACIONES,PRE_CONDICION,PRE_ESTADO) VALUES (1,$est,$libro,TO_DATE('$fpresta', 'yyyy/mm/dd'),TO_DATE('$fdevol','yyyy/mm/dd'),$cantidad,'$observacion','$condicion',1)";
	$stid = oci_parse( $conexion, $query );
	$ok = oci_execute( $stid );
}else{
	$id_nuevo = oci_parse($conexion, "Select * from PRESTAMO");
	$r2 = oci_execute($id_nuevo);
	while ( $row = oci_fetch_array( $id_nuevo ) ) {
		$aux = $row['PRE_ID'];
	}
	$aux = $aux+1;
	$query = "INSERT INTO prestamo(PRE_ID,EST_ID, LIB_ID,PRE_FECHAPRESTADO,PRE_FECHADEVUELTO,PRE_CANTIDAD,PRE_OBSERVACIONES,PRE_CONDICION,PRE_ESTADO) VALUES ($aux,$est,$libro,TO_DATE('$fpresta', 'yyyy/mm/dd'),TO_DATE('$fdevol','yyyy/mm/dd'),$cantidad,'$observacion','$condicion',1)";

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
	$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, PRE_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$aux,$user,'Registro prestamo')";
	$stid_aud = oci_parse( $conexion, $query_auditoria );
	oci_execute( $stid_aud );
}else{
	
	$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
	$r2_auditoria = oci_execute($id_nuevo_auditoria);
	while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
		$aux_auditoria = $row_aud['AUD_ID'];
	}
	
	$aux_auditoria = $aux_auditoria+1;
	$auditoria = "INSERT INTO AUDITORIA (AUD_ID, PRE_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$aux,$user,'Registro prestamo')";
	$stid2 = oci_parse( $conexion, $auditoria );
	oci_execute( $stid2 );
}
/////////////////////////////////////////////////////////////////////////////////////////////////////


if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_prestamo.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');/*window.history.go(-1);*/</script>";
}
oci_free_statement($stid); 
?>