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

	if($r){
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