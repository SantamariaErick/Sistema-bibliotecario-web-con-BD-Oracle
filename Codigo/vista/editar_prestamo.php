<!doctype html>
<html>
<head>
	<meta charset="utf-8">
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
	<div class="contenido">
		<div class="form-contenedor">
			<form id="form1" name="form1" method="post">
				<h1 class="centrar titulo">Formulario prestamo</h1>

				<div class="row">
					<div class="form-dividido2 formulario__grupo" id="grupo__id">
						<p><label for="id" class="formulario__label">ID </label>
						</p>
						<input type="number" class="formulario__input" name="id" id="id" placeholder="Ingrese el id" value="<?php echo $fila[0]?>" disabled>
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="estudiante" class="formulario__label">Estudiante</label>
						</p>
						<p>
							<select name="estudiante" id="estudiante">
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
					<div class="form-dividido2 formulario__grupo">
						<p><label for="libro" class="formulario__label">Libro</label>
						</p>
						<p>
							<select name="libro" id="libro">
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
					<div class="form-dividido2 formulario__grupo" id="grupo__nombre">
					  <p><label for="nombre" class="formulario__label">Fecha prestado</label>
						</p>
						<input name="fpresta" type="date"  required class="formulario__input" id="fpresta" value="<?php echo $fila[3]?>">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p>
							<label for="fdevol" class="formulario__label">Fecha devolucion </label>
						</p>
						<input name="fdevol" type="date" value="<?php echo $fila[4]?>" required class="formulario__input" id="fdevol">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="cantidad" class="formulario__label">Cantidad </label>
						</p>
						<input name="cantidad" type="number" value="<?php echo $fila[5]?>" required class="formulario__input" id="cantidad" max="30" min="0" step="1">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="observacion" class="formulario__label">Observaciones</label>
						</p>
						<input name="observacion" value="<?php echo $fila[6]?>" type="text" required class="formulario__input" id="observacion">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="condicion" class="formulario__label">Estado</label>
						</p>
						<p>
							<select name="condicion" id="condicion">
								<option value="prestado">Prestado</option>
								<option value="devuelto">Devuelto</option>
							</select>
						</p>
					</div>
					<div class="row">
						<p class="centrar4">
							<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
							<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
							<div class="volver2"><a href="libro.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a>
							</div>
					</div>
			</form>
			</div>
		</div>
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