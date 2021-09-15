<?php
	$id = $_POST['id'];
	$codigo = $_POST['codigo'];
	$cedula = $_POST['cedula'];
	$nombre = $_POST['Nombre'];
	$carrera = $_POST['carrera'];
	$direccion= $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];

	require('../controlador/Conexion.php');

	$actualizar = "UPDATE ESTUDIANTE SET EST_CODIGO ='$codigo', EST_CEDULA='$cedula', EST_NOMBRE='$nombre', EST_CARRERA= '$carrera', EST_DIRECCION='$direccion', EST_TELEFONO='$telefono', EST_EMAIL='$email' WHERE EST_ID= $id ";

	$stid = oci_parse($conexion, $actualizar);

	if (!$stid) {
		$e = oci_error($conexion);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// Realizar la lógica de la consulta
	$r = oci_execute($stid);
	
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	$stid_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
	$r = oci_execute($stid_auditoria);
	$row_auditoria = oci_fetch_array($stid_auditoria,OCI_ASSOC); 
	session_start();
	$user = $_SESSION['user'];

	if($row_auditoria == 0){
		$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Editó estudiante')";
		$stid_aud = oci_parse( $conexion, $query_auditoria );
		oci_execute( $stid_aud );
	}else{

		$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
		$r2_auditoria = oci_execute($id_nuevo_auditoria);
		while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
			$aux_auditoria = $row_aud['AUD_ID'];
		}

		$aux_auditoria = $aux_auditoria+1;
		$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Editó estudiante')";
		$stid2 = oci_parse( $conexion, $auditoria );
		oci_execute( $stid2 );
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	
	if($r &&($stid_aud ||$stid2 )){
		echo '<script>
				alert("Los datos se han actualizado correctamente");
				window.location="estudiante.php";
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