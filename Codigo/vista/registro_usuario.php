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
	$trabajador = $_POST[ 'trabajador' ];
	$cedula = $_POST[ 'cedula' ];
	$nombre = $_POST[ 'nombre' ]; 
	$profesion = $_POST[ 'profesion' ];
	$cargo = $_POST[ 'direccion' ];
	$direccion = $_POST[ 'cargo' ]; 
	$email = $_POST[ 'email' ];
	$telefono = $_POST[ 'telefono' ];
	$login = $_POST[ 'login' ];
	$clave = $_POST[ 'clave' ];
	$estado = 1;

	$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');

	$usuario= oci_parse($conexion, "Select * from USUARIO");
	$r = oci_execute($usuario);
	$row_ini = oci_fetch_array($usuario,OCI_ASSOC);
	
	
	if($row_ini == 0){
		$query =   "INSERT INTO usuario(usu_id, usu_trabajador, usu_cedula, usu_nombre, usu_profesion, usu_cargo, usu_direccion, usu_telefono, usu_email, usu_login, usu_clave, usu_estado) VALUES (1,'$trabajador','$cedula','$nombre','$profesion','$cargo','$direccion','$telefono','$email','$login','$clave',$estado)";
		
		$stid = oci_parse( $conexion, $query );
		oci_execute( $stid );
	}else{

		$id_nuevo = oci_parse($conexion, "Select * from USUARIO");
		$r2 = oci_execute($id_nuevo);
		while ( $row = oci_fetch_array( $id_nuevo ) ) {
			$aux = $row['USU_ID'];
		}

		$aux = $aux+1;

		$query =  "INSERT INTO usuario(usu_id, usu_trabajador, usu_cedula, usu_nombre, usu_profesion, usu_cargo, usu_direccion, usu_telefono, usu_email, usu_login, usu_clave, usu_estado) VALUES ($aux,'$trabajador','$cedula','$nombre','$profesion','$cargo','$direccion','$telefono','$email','$login','$clave',$estado)";
		$stid = oci_parse( $conexion, $query );
		$ok = oci_execute( $stid );

	}
	

	if ( $ok ) {
		echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="formulario_estudiante.php";</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Administador');</script>";
	}

	?>
</body>
</html>