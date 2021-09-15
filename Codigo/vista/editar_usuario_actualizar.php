<?php
	$id = $_POST['id'];
	$trabajador = $_POST['trabajador'];
	$cedula = $_POST['cedula'];
	$nombre = $_POST['nombre'];
	$profesion = $_POST['profesion'];
	$cargo = $_POST['cargo'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];
	$usuario = $_POST['usuario'];
	//$condicion= $_POST['condicion'];

	require('../controlador/Conexion.php');

	$actualizar = "UPDATE USUARIO SET USU_TRABAJADOR ='$trabajador', USU_CEDULA='$cedula', USU_NOMBRE = '$nombre', USU_PROFESION = '$profesion', USU_CARGO = '$cargo', USU_DIRECCION = '$direccion', USU_TELEFONO = '$telefono', USU_EMAIL = '$email', USU_LOGIN = '$usuario' WHERE USU_ID = $id ";

	$stid = oci_parse($conexion, $actualizar);

	if (!$stid) {
		$e = oci_error($conexion);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// Realizar la lógica de la consulta
	$r = oci_execute($stid);

	if($r){
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

			$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Actualizo usuario')";
			$stid2 = oci_parse( $conexion, $auditoria );
			oci_execute( $stid2 );
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////
		
		echo '<script>
				alert("Los datos se han actualizado correctamente");
				window.location="usuario.php";
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