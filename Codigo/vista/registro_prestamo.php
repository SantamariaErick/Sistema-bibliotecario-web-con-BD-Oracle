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

if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_editorial.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');/*window.history.go(-1);*/</script>";
}
oci_free_statement($stid); 
?>