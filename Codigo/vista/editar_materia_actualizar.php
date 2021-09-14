<?php
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$condicion= $_POST['condicion'];

	require('../controlador/Conexion.php');

	$actualizar = "UPDATE MATERIA SET MAT_NOMBRE='$nombre', MAT_DESCRIPCION='$descripcion', MAT_CONDICION='$condicion' WHERE MAT_ID= $id ";

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
				window.location="materia.php";
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