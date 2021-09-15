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
	$nombre = $_POST[ 'nombre' ];
	$descripcion = $_POST[ 'descripcion' ];
	$estado = 1;

	$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');

	$repetido = 0;
	
	
	$query_rep1 = "Select mat_nombre from materia where mat_id = $id";
	$stid = oci_parse($conexion, $query_rep1);
	oci_execute($stid);



	$query = "INSERT INTO materia(mat_id, mat_nombre, mat_descripcion, mat_estado) VALUES ($id,'$nombre','$descripcion',$estado)";

	$stid = oci_parse($conexion, $query);
	$ok = oci_execute($stid);

	if ( $ok ) {
		echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_materia.php";</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
	}



	
	?>
</body>
</html>