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
		/////////////////////////////////////////////////////////////////////////////////////////////////////
		$stid_auditoria = oci_parse($conexion, "Select * from AUDITORIA order by AUD_ID asc");
		$r = oci_execute($stid_auditoria);
		$row_auditoria = oci_fetch_array($stid_auditoria,OCI_ASSOC); 
		session_start();
		$user = $_SESSION['user'];

		if($row_auditoria == 0){
			$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Agrego materia')";
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

			$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Agrego materia')";
			$stid2 = oci_parse( $conexion, $auditoria );
			oci_execute( $stid2 );
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		echo '<script>window.alert("Los datos se han guardado exitosamente");</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
	}



	
	?>
</body>
</html>