<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<form id="form1" name="form1" method="post" action="registro_libro.php">
		<h1 class="centrar titulo">Formulario libro</h1>

		<div class="row">
			<div class="form-dividido2 formulario__grupo">
				<p><label for="materia" class="formulario__label">Materia</label>
				</p>
				<p>
					<select name="materia" id="materia">
						<?php
						require( '../controlador/Conexion.php' );
						$stid = oci_parse( $conexion, "SELECT * FROM materia" );
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
							echo '<option value = "' . $row[ 0 ] . '">' . $row[ 1 ] . '</option>';
						}
						oci_free_statement( $stid );
						?>
					</select>
				</p>
			</div>
			<div class="form-dividido2 formulario__grupo">
				<p><label for="editorial" class="formulario__label">Editorial</label>
				</p>
				<p>
					<select name="editorial" id="editorial">
						<?php
						$stid = oci_parse( $conexion, "SELECT * FROM editorial" );
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
							echo '<option value = "' . $row[ 0 ] . '">' . $row[ 1 ] . '</option>';
						}
						oci_free_statement( $stid );
						?>
					</select>
				</p>
			</div>
			<div class="form-dividido2 formulario__grupo">
				<p><label for="autor" class="formulario__label">Autor</label>
				</p>
				<p>
					<select name="autor" id="autor">
						<?php
						$stid = oci_parse( $conexion, "SELECT * FROM autor" );
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
							echo '<option value = "' . $row[ 0 ] . '">' . $row[ 1 ] . '</option>';
						}
						oci_free_statement( $stid );
						?>
					</select>
				</p>
			</div>
			<div class="form-dividido2 formulario__grupo" id="grupo__nombre">
				<p><label for="nombre" class="formulario__label">Titulo </label>
				</p>
				<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingrese el nombre" required>
			</div>
			<div class="form-dividido2 formulario__grupo">
				<p>
					<label for="cantidadDisp" class="formulario__label">Cantidad disponible </label>
				</p>
				<input name="cantidadDisp" type="number" required class="formulario__input" id="cantidadDisp" min="0" step="1">
			</div>
			<div class="form-dividido2 formulario__grupo">
				<p><label for="anioEd" class="formulario__label">Año de edición </label>
				</p>
				<input name="anioEd" type="number" required class="formulario__input" id="anioEd" max="2021" min="0" step="1">
			</div>
			<div class="form-dividido2 formulario__grupo">
				<p><label for="cantidadPag" class="formulario__label">Cantidad de páginas </label>
				</p>
				<input name="cantidadPag" type="number" required class="formulario__input" id="cantidadPag" min="1" step="1">
			</div>
			<div class="form-dividido2 formulario__grupo">
				<p><label for="formato" class="formulario__label">Formato </label>
				</p>
				<p>
					<select name="formato" id="formato">
						<option value="fisico">Fisico</option>
						<option value="digital">Digital</option>
					</select>
				</p>
			</div>
			<div class="form-dividido2 formulario__grupo">
				<p><label for="peso" class="formulario__label">Peso</label>
				</p>
				<input name="peso" type="number" required class="formulario__input" id="peso" min="0" step="0.01">
			</div>
			<div class="form-dividido2 formulario__grupo" id="grupo__descripcion">
				<p><label for="descripcion" class="formulario__label">Descripcion </label>
				</p>
				<input type="text" class="formulario__input" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" required>
			</div>

			<div class="form-dividido2 formulario__grupo" id="grupo__descripcion">
				<p><label for="descripcion" class="formulario__label">Portada</label>
				</p>
				<input type="file" class="formulario__input" name="imagen" id="imagen" required>
			</div>
		</div>


		<div class="row">
			<p class="centrar4">
				<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
				<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>Restablecer</button>
				<div class="volver2"><a href="libro.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a>
				</div>
		</div>
	</form>
</body>
</html>