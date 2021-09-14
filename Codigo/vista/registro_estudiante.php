<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

	<?php
	$mensaje = "";
	
	$id = $_POST[ 'id' ]; 
	$codigo = $_POST[ 'codigo' ];
	$cedula = $_POST[ 'cedula' ];
	$nombre = $_POST[ 'nombre' ]; 
	$carrera = $_POST[ 'carrera' ];
	$direccion = $_POST[ 'direccion' ];
	$telefono = $_POST[ 'telefono' ]; 
	$email = $_POST[ 'email' ];
	$estado = 1;

	$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');

	$repetido = 0;
	
	
	$query_rep1 = "Select est_nombre from materia where est_id = $id";
	$stid = oci_parse($conexion, $query_rep1);
	oci_execute($stid);



	$query = "INSERT INTO estudiante(est_id, est_codigo, est_cedula, est_nombre, est_carrera, est_direccion, est_telefono, est_email, est_estado) VALUES ($id,'$codigo','$cedula','$nombre','$carrera','$direccion','$telefono','$email',$estado)";

	$stid = oci_parse($conexion, $query);
	$ok = oci_execute($stid);

	if ( $ok ) {
		echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_estudiante.php";</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
	}

	?>
</body>
</html>