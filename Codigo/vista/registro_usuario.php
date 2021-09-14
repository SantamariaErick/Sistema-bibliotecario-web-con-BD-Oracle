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
	$trabajador = $_POST[ 'codigo' ];
	$cedula = $_POST[ 'cedula' ];
	$nombre = $_POST[ 'nombre' ]; 
	$profesion = $_POST[ 'carrera' ];
	$cargo = $_POST[ 'direccion' ];
	$direccion = $_POST[ 'telefono' ]; 
	$telefono = $_POST[ 'email' ];
	$login = $_POST[ 'login' ];
	$clave = $_POST[ 'clave' ];
	$email = 1;

	$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');

	$repetido = 0;
	
	
	$query_rep1 = "Select usu_nombre from usuario where usu_id = $id";
	$stid = oci_parse($conexion, $query_rep1);
	oci_execute($stid);



	$query = "INSERT INTO usuario(usu_id, usu_trabajador, usu_cedula, usu_nombre, usu_profesion, usu_cargo, usu_direccion, usu_telefono, usu_email, usu_login, usu_clave) VALUES ($id,'$trabajador','$cedula','$nombre','$profesion','$cargo','$direccion','$telefono','$login','$clave')";

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