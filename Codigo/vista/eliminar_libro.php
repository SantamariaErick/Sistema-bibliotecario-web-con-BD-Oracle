<?php

require('../controlador/Conexion.php');

$id = $_GET['id'];

$consultar = "SELECT * FROM LIBRO WHERE LIB_ID = $id";
$stid = oci_parse($conexion, $consultar);
$r = oci_execute($stid);

while ( $row = oci_fetch_array($stid) ) {
	$estado = $row["LIB_ESTADO"];
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

$eliminar = "UPDATE LIBRO SET LIB_ESTADO = $estado WHERE LIB_ID = $id";
$stid = oci_parse($conexion, $eliminar);
$r2 = oci_execute($stid);

if($r && $r2){
	/////////////////////////////////////////////////////////////////////////////////////////////////////
		$stid_auditoria = oci_parse($conexion, "Select * from AUDITORIA order by AUD_ID asc");
		$r = oci_execute($stid_auditoria);
		$row_auditoria = oci_fetch_array($stid_auditoria,OCI_ASSOC); 
		session_start();
		$user = $_SESSION['user'];

		if($row_auditoria == 0){
			$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Actualizo usuario')";
			$stid_aud = oci_parse( $conexion, $query_auditoria );
			oci_execute( $stid_aud );
		}else{

			$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA order by AUD_ID asc");
			$r2_auditoria = oci_execute($id_nuevo_auditoria);
			while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
				$aux_auditoria = $row_aud['AUD_ID'];
			}

			$aux_auditoria = $aux_auditoria+1;

			echo "<script>alert($aux_auditoria);</script>";

			$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Modifico estado libro')";
			$stid2 = oci_parse( $conexion, $auditoria );
			oci_execute( $stid2 );
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="libro.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al eliminar");
			window.history.go(-1);
		</script>';
}
?>