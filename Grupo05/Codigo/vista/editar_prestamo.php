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

	$stid = oci_parse( $conexion, "SELECT * FROM PRESTAMO where PRE_ID = $id" );

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
		<h1 class="centrar titulo">Formulario prestamo</h1>

		<div class="row">
			<div class="form-group col-md-6">
				<p><label for="estudiante" class="formulario__label">Estudiante</label>
				</p>
				<p>
					<select name="estudiante" id="estudiante" class="form-control">
						<?php
						$stid = oci_parse( $conexion, "SELECT * FROM estudiante" );
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
						while ( $row = oci_fetch_array( $stid ) ) {
							echo '<option value = "' . $row[ 0 ] . '">' . $row[ 3 ] . ' con CI: ' . $row[ 2 ] . '</option>';
						}
						oci_free_statement( $stid );
						?>
					</select>
				</p>
			</div>
			<div class="form-group col-md-6">
				<p><label for="libro">Libro</label>
				</p>
				<p>
					<select name="libro" id="libro" class="form-control">
						<?php
						$stid = oci_parse( $conexion, "SELECT * FROM libro" );
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
						while ( $row = oci_fetch_array( $stid ) ) {
							echo '<option value = "' . $row[ 0 ] . '">' . $row[ 4 ] . '</option>';
						}
						oci_free_statement( $stid );
						?>
					</select>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4" id="grupo__nombre">
				<p><label for="nombre" class="formulario__label">Fecha prestado</label>
				</p>
				<input type="date" value="<?php echo $fila[3]?>" class="form-control" name="fpresta" id="fpresta" required>
			</div>
			<div class="form-group col-md-4">
				<p>
					<label for="fdevol">Fecha devolucion </label>
				</p>
				<input name="fdevol" value="<?php echo $fila[4]?>" type="date" required class="form-control" id="fdevol">
			</div>
			<div class="form-group col-md-4">
				<p><label for="cantidad">Cantidad </label>
				</p>
				<input name="cantidad" type="number" value="<?php echo $fila[5]?>" required class="form-control" id="cantidad" max="30" min="0" step="1">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-10">
				<p><label for="observacion">Observaciones</label>
				</p>
				<input name="observacion" value="<?php echo $fila[6]?>" type="text" required class="form-control" id="observacion">
			</div>
			<div class="form-group col-md-2">
				<p><label for="condicion">Estado</label>
				</p>
				<p>
					<select name="condicion" id="condicion" class="form-control">
						<option value="prestado">Prestado</option>
						<option value="devuelto">Devuelto</option>
					</select>
				</p>
			</div>
		</div>
		<div class="botones">
			<button type="submit" name="enviar" id="idsubmit" value="ingresar" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
			<button class="btn btn-primary" type="reset" name="resetear" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>&nbsp;&nbsp;Limpiar</button>
			<a href="prestamo.php"><button class="btn btn-primary" type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>&nbsp;&nbsp;Volver</button></a>
		</div>
	</form>
	<?php
	if ( isset( $_POST[ 'enviar' ] ) ) //Si detecta el boton de enviar 
	{
		$est = $_POST[ 'estudiante' ];
		$libro = $_POST[ 'libro' ];
		$fpresta = $_POST[ 'fpresta' ];
		$fdevol = $_POST[ 'fdevol' ];
		$cantidad = $_POST[ 'cantidad' ];
		$observacion = $_POST[ 'observacion' ];
		$condicion = $_POST[ 'condicion' ];
		$actualizar = "UPDATE PRESTAMO SET EST_ID=$est, LIB_ID=$libro, PRE_FECHAPRESTADO= TO_DATE('$fpresta', 'yyyy/mm/dd'), PRE_FECHADEVUELTO= TO_DATE('$fdevol','yyyy/mm/dd'), PRE_CANTIDAD=$cantidad, PRE_OBSERVACIONES='$observacion',PRE_CONDICION='$condicion' WHERE PRE_ID= $fila[0]";

		$stid = oci_parse( $conexion, $actualizar );

		if ( !$stid ) {
			$e = oci_error( $conexion );
			trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
		}

		// Realizar la lógica de la consulta
		$r = oci_execute( $stid );

		if ( $r ) {
			/////////////////////////////////////////////////////////////////////////////////////////////////////
			$stid_auditoria = oci_parse( $conexion, "Select * from AUDITORIA order by AUD_ID asc" );
			$r = oci_execute( $stid_auditoria );
			$row_auditoria = oci_fetch_array( $stid_auditoria, OCI_ASSOC );
			session_start();
			$user = $_SESSION[ 'user' ];

			if ( $row_auditoria == 0 ) {
				$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Actualizo prestamo')";
				$stid_aud = oci_parse( $conexion, $query_auditoria );
				oci_execute( $stid_aud );
			} else {

				$id_nuevo_auditoria = oci_parse( $conexion, "Select * from AUDITORIA order by AUD_ID asc" );
				$r2_auditoria = oci_execute( $id_nuevo_auditoria );
				while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
					$aux_auditoria = $row_aud[ 'AUD_ID' ];
				}

				$aux_auditoria = $aux_auditoria + 1;
				$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Actualizo prestamo')";
				$stid2 = oci_parse( $conexion, $auditoria );
				oci_execute( $stid2 );
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////


			echo '<script>
				alert("Los datos se han actualizado correctamente");
				window.location="prestamo.php";
			</script>';
		} else {
			echo '<script>
				alert("Hubo un error al guardar");
				window.history.go(-1);
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