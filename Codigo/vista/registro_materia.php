<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

	<?php
	$mensaje = "";
	
	//$id = $_POST[ 'id' ]; 
	$nombre = $_POST[ 'nombre' ];
	$descripcion = $_POST[ 'descripcion' ];
	$estado = 1;

	$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');

	$materia = oci_parse($conexion, "Select * from MATERIA");
	$r = oci_execute($materia);
	$row_ini = oci_fetch_array($materia,OCI_ASSOC);
	
	if($row_ini == 0){
		$query =  "INSERT INTO materia(mat_id, mat_nombre, mat_descripcion, mat_estado) VALUES (1,'$nombre','$descripcion',$estado)";
		$stid = oci_parse( $conexion, $query );
		oci_execute( $stid );
	}else{

		$id_nuevo = oci_parse($conexion, "Select * from MATERIA");
		$r2 = oci_execute($id_nuevo);
		while ( $row = oci_fetch_array( $id_nuevo ) ) {
			$aux = $row['MAT_ID'];
		}

		$aux = $aux+1;

		$query = "INSERT INTO materia(mat_id, mat_nombre, mat_descripcion, mat_estado) VALUES ($aux,'$nombre','$descripcion',$estado)";
		$stid = oci_parse( $conexion, $query );
		$ok = oci_execute( $stid );

	}
	
	


	if ( $ok ) {
		echo '<script>window.alert("Los datos se han guardado exitosamente");</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
	}



	
	?>
</body>
</html>