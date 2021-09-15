<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<div class="contenido">
		<div class="form-contenedor">
			<form id="form1" name="form1" method="post" action="registro_prestamo.php">
				<h1 class="centrar titulo">Formulario prestamo</h1>

				<div class="row">
					<div class="form-dividido2 formulario__grupo" id="grupo__id">

					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="estudiante" class="formulario__label">Estudiante</label>
						</p>
						<p>
							<select name="estudiante" id="estudiante">
								<?php
								require( '../controlador/Conexion.php' );
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
									echo '<option value = "' . $row[ 0 ] . '">' . $row[ 3 ].' con CI: '.$row[2] . '</option>';
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
						<input type="date" class="formulario__input" name="fpresta" id="fpresta" required>
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p>
							<label for="fdevol" class="formulario__label">Fecha devolucion </label>
						</p>
						<input name="fdevol" type="date" required class="formulario__input" id="fdevol">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="cantidad" class="formulario__label">Cantidad </label>
						</p>
						<input name="cantidad" type="number" required class="formulario__input" id="cantidad" max="30" min="0" step="1">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="observacion" class="formulario__label">Observaciones</label>
						</p>
						<input name="observacion" type="text" required class="formulario__input" id="observacion">
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
</body>
</html>