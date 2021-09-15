<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>

	<?php
	require( '../controlador/Conexion.php' );
	$codigo = $_POST[ 'codigo' ];
	$cedula = $_POST[ 'cedula' ];
	$nombre = $_POST[ 'nombre' ];
	$carrera = $_POST[ 'carrera' ];
	$direccion = $_POST[ 'direccion' ];
	$telefono = $_POST[ 'telefono' ];
	$email = $_POST[ 'email' ];
	$estado = 1;

	$prestamo = oci_parse( $conexion, "Select * from ESTUDIANTE" );
	$r = oci_execute( $prestamo );
	$row_ini = oci_fetch_array( $prestamo, OCI_ASSOC );
	if ( $row_ini == 0 ) {
		$query = "INSERT INTO estudiante(est_id, est_codigo, est_cedula, est_nombre, est_carrera, est_direccion, est_telefono, est_email, est_estado) VALUES (1,'$codigo','$cedula','$nombre','$carrera','$direccion','$telefono','$email',$estado)";
		$stid = oci_parse( $conexion, $query );
		oci_execute( $stid );
	} else{
	$id_nuevo = oci_parse($conexion, "Select * from ESTUDIANTE");
	$r2 = oci_execute($id_nuevo);
	while ( $row = oci_fetch_array( $id_nuevo ) ) {
		$aux = $row['EST_ID'];
	}
	
	$aux = $aux+1;
	
	$query = "INSERT INTO estudiante(est_id, est_codigo, est_cedula, est_nombre, est_carrera, est_direccion, est_telefono, est_email, est_estado) VALUES ($aux,'$codigo','$cedula','$nombre','$carrera','$direccion','$telefono','$email',$estado)";

	$stid = oci_parse( $conexion, $query );
	$ok = oci_execute( $stid );
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
$stid_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
$r = oci_execute($stid_auditoria);
$row_auditoria = oci_fetch_array($stid_auditoria,OCI_ASSOC); 
session_start();
$user = $_SESSION['user'];

if($row_auditoria == 0){
	$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Registro estudiante')";
	$stid_aud = oci_parse( $conexion, $query_auditoria );
	oci_execute( $stid_aud );
}else{
	
	$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
	$r2_auditoria = oci_execute($id_nuevo_auditoria);
	while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
		$aux_auditoria = $row_aud['AUD_ID'];
	}
	
	$aux_auditoria = $aux_auditoria+1;
	
	echo "<script>alert($aux_auditoria);</script>";
	
	$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Registro estudiante')";
	$stid2 = oci_parse( $conexion, $auditoria );
	oci_execute( $stid2 );
}
/////////////////////////////////////////////////////////////////////////////////////////////////////


		if ( $ok &&($stid2 || $stid_aud) ) {
			echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_estudiante.php";</script>';
		} else {
			echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
		}

		?>
</body>
</html>