<?php
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	//$condicion= $_POST['condicion'];

	require('../controlador/Conexion.php');

	$actualizar = "UPDATE MATERIA SET MAT_NOMBRE='$nombre', MAT_DESCRIPCION='$descripcion' WHERE MAT_ID= $id ";

	$stid = oci_parse($conexion, $actualizar);

	if (!$stid) {
		$e = oci_error($conexion);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// Realizar la lógica de la consulta
	$r = oci_execute($stid);

	if($r){
		/////////////////////////////////////////////////////////////////////////////////////////////////////
		$stid_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
		$r = oci_execute($stid_auditoria);
		$row_auditoria = oci_fetch_array($stid_auditoria,OCI_ASSOC); 
		session_start();
		$user = $_SESSION['user'];

		if($row_auditoria == 0){
			$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Actualizo materia')";
			$stid_aud = oci_parse( $conexion, $query_auditoria );
			oci_execute( $stid_aud );
		}else{

			$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
			$r2_auditoria = oci_execute($id_nuevo_auditoria);
			while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
				$aux_auditoria = $row_aud['AUD_ID'];
			}

			$aux_auditoria = $aux_auditoria+1;

			echo "<script>alert($aux_auditoria);</script>";

			$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Actualizo materia')";
			$stid2 = oci_parse( $conexion, $auditoria );
			oci_execute( $stid2 );
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////

		
		echo '<script>
				alert("Los datos se han actualizado correctamente");

			</script>';

	} else{
		echo '<script>
				alert("Hubo un error al guardar");
				window.history.go(-1);
			</script>';
	}

	if (!$r) {
		$e = oci_error($stid);//Algun error al consultar
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}


?>