<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="../public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../public/css/estilo_paginasTabl.css" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<title>Documento sin título</title>
</head>

<body>
	<?php
	$id = $_GET[ 'id' ];
	require( '../controlador/Conexion.php' );

	$stid = oci_parse( $conexion, "SELECT * FROM EDITORIAL where EDI_ID = $id" );

	if ( !$stid ) {
		$e = oci_error( $conexion );
		trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
	}

	// Realizar la lógica de la consulta
	$r = oci_execute( $stid );
	if ( !$r ) {
		$e = oci_error( $stid ); //Algun error al consultar
		trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
	}
	$fila = oci_fetch_array( $stid );
	?>
	<form id="form1" name="form1" method="post">
		<h1 class="centrar titulo">Formulario editorial</h1>

		<div class="row	">
			<div class="form-group col-md-4">
				<p><label for="nombre" class="formulario__label">Nombre </label>
				</p>
				<input value="<?php echo $fila[1]?>" type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre" required>
			</div>
		</div>
		<div class="row	">
			<div class="form-group col-md-4">
				<p><label for="descripcion" class="formulario__label">Descripcion </label>
				</p>
				<input value="<?php echo $fila[2]?>" type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" required>
			</div>
		</div>
		<div class="botones">
			<button type="submit" name="enviar" id="idsubmit" value="ingresar" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
			<button class="btn btn-primary" type="reset" name="resetear" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>&nbsp;&nbsp;Limpiar</button>
			<a href="editorial.php"><button class="btn btn-primary" type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>&nbsp;&nbsp;Volver</button></a>
		</div>
	</form>
	<?php
	if ( isset( $_POST[ 'enviar' ] ) ) //Si detecta el boton de enviar 
	{
		$nombre = $_POST[ 'nombre' ];
		$descripcion = $_POST[ 'descripcion' ];

		$actualizar = "UPDATE EDITORIAL SET EDI_NOMBRE ='$nombre', EDI_DESCRIPCION='$descripcion' WHERE EDI_ID = $id ";

		$stid = oci_parse( $conexion, $actualizar );

		if ( !$stid ) {
			$e = oci_error( $conexion );
			trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
		}

		// Realizar la lógica de la consulta
		$r = oci_execute( $stid );

		/////////////////////////////////////////////////////////////////////////////////////////////////////
		$stid_auditoria = oci_parse( $conexion, "Select * from AUDITORIA" );
		$r = oci_execute( $stid_auditoria );
		$row_auditoria = oci_fetch_array( $stid_auditoria, OCI_ASSOC );
		session_start();
		$user = $_SESSION[ 'user' ];

		if ( $row_auditoria == 0 ) {
			$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Editó editorial')";
			$stid_aud = oci_parse( $conexion, $query_auditoria );
			oci_execute( $stid_aud );
		} else {

			$id_nuevo_auditoria = oci_parse( $conexion, "Select * from AUDITORIA" );
			$r2_auditoria = oci_execute( $id_nuevo_auditoria );
			while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
				$aux_auditoria = $row_aud[ 'AUD_ID' ];
			}

			$aux_auditoria = $aux_auditoria + 1;
			$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Editó editorial')";
			$stid2 = oci_parse( $conexion, $auditoria );
			oci_execute( $stid2 );
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////

		if ( $r && ( $stid_aud || $stid2 ) ) {
			echo '<script>
				alert("Los datos se han actualizado correctamente");
				window.location="editorial.php";
			</script>';
		} else {
			echo '<script>
				alert("Hubo un error al guardar");
				/*window.history.go(-1);*/
			</script>';
		}

		if ( !$r ) {
			$e = oci_error( $stid ); //Algun error al consultar
			trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
		}
	}
	?>
</body>
</html>