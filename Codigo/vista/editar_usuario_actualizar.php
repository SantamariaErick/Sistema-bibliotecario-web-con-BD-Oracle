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