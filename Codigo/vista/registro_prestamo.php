<?php
require('../controlador/Conexion.php');
$id = $_POST[ 'id' ];
$est = $_POST['estudiante'];
$libro = $_POST['libro'];
$fpresta = $_POST['fpresta'];
$fdevol = $_POST[ 'fdevol' ];
$cantidad=$_POST['cantidad'];
$observacion=$_POST['observacion'];
$condicion = $_POST['condicion'];
$query = "INSERT INTO prestamo(PRE_ID,EST_ID, LIB_ID,PRE_FECHAPRESTADO,PRE_FECHADEVUELTO,PRE_CANTIDAD,PRE_OBSERVACIONES,PRE_CONDICION,PRE_ESTADO) VALUES ($id,$est,$libro,TO_DATE('$fpresta', 'yyyy/mm/dd'),TO_DATE('$fdevol','yyyy/mm/dd'),$cantidad,'$observacion','$condicion',1)";

$stid = oci_parse( $conexion, $query );
$ok = oci_execute( $stid );


$stid = oci_parse($conexion, "Select * from AUDITORIA");
$r = oci_execute($stid);
$row = oci_fetch_array($stid,OCI_ASSOC); 

session_start();
$user = $_SESSION['user'];

if($row == 0){
	$query = "INSERT INTO AUDITORIA (AUD_ID, PRE_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$id,$user,TO_DATE('$fpresta','yyyy/mm/dd'))";
	$stid = oci_parse( $conexion, $query );
	oci_execute( $stid );
}else{
	
	$id_nuevo = oci_parse($conexion, "Select * from AUDITORIA");
	$r2 = oci_execute($id_nuevo);
	while ( $row = oci_fetch_array( $id_nuevo ) ) {
		$aux = $row['AUD_ID'];
	}
	
	$aux = $aux+1;
	
	echo "<script>alert($aux);</script>";
	
	$auditoria = "INSERT INTO AUDITORIA (AUD_ID, PRE_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux,$id,$user,TO_DATE('$fpresta','yyyy/mm/dd'))";
	$stid2 = oci_parse( $conexion, $auditoria );
	oci_execute( $stid2 );
}

if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_editorial.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');/*window.history.go(-1);*/</script>";
}
oci_free_statement($stid); 
?>