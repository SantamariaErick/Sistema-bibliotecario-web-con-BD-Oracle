<?php

require('../controlador/Conexion.php');

$id = $_GET['id'];

$consultar = "SELECT * FROM PRESTAMO WHERE PRE_ID = $id";
$stid = oci_parse($conexion, $consultar);
$r = oci_execute($stid);

while ( $row = oci_fetch_array($stid) ) {
	$estado = $row["PRE_ESTADO"];
}

if (!$stid) {
	$e = oci_error($conexion);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
// Realizar la lógica de la consulta
if($estado == '1'){
	$estado = '0';
	$msj = 'eliminado';
} else {
	$estado = '1';
	$msj = 'activado';
}

$eliminar = "UPDATE PRESTAMO SET PRE_ESTADO = $estado WHERE PRE_ID = $id";
$stid = oci_parse($conexion, $eliminar);
$r2 = oci_execute($stid);

if($r && $r2){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="prestamo.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al eliminar");
			window.history.go(-1);
		</script>';
}
?>