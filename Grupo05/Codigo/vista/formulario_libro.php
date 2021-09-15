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
	<form id="form1" name="form1" method="post" action="registro_libro.php">
		<h1 class="centrar titulo">Formulario libro</h1>

		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="materia" class="formulario__label">Materia</label>
				</p>
				<p>
					<select name="materia" id="materia" class="form-control">
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
			<div class="form-group col-md-4">
				<p><label for="editorial" class="formulario__label">Editorial</label>
				</p>
				<p>
					<select name="editorial" id="editorial" class="form-control">
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
			<div class="form-group col-md-4">
				<p><label for="autor" class="formulario__label">Autor</label>
				</p>
				<p>
					<select name="autor" id="autor" class="form-control">
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
			</div>
		<div class="row">
			<div class="form-group col-md-4" id="grupo__nombre">
				<p><label for="nombre" class="formulario__label">Titulo </label>
				</p>
				<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre" required>
			</div>
			<div class="form-group col-md-4">
				<p>
					<label for="cantidadDisp" class="formulario__label">Cantidad disponible </label>
				</p>
				<input name="cantidadDisp" type="number" required class="form-control" id="cantidadDisp" min="0" step="1">
			</div>
			<div class="form-group col-md-4">
				<p><label for="anioEd" class="formulario__label">Año de edición </label>
				</p>
				<input name="anioEd" type="number" required class="form-control" id="anioEd" max="2021" min="0" step="1">
			</div>
			</div>
		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="cantidadPag" class="formulario__label">Cantidad de páginas </label>
				</p>
				<input name="cantidadPag" type="number" required class="form-control" id="cantidadPag" min="1" step="1">
			</div>
			<div class="form-group col-md-4">
				<p><label for="formato" class="formulario__label">Formato </label>
				</p>
				<p>
					<select name="formato" id="formato" class="form-control">
						<option value="fisico">Fisico</option>
						<option value="digital">Digital</option>
					</select>
				</p>
			</div>
			<div class="form-group col-md-4">
				<p><label for="peso" class="formulario__label">Peso</label>
				</p>
				<input name="peso" type="number" required class="form-control" id="peso" min="0" step="0.01">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<p><label for="descripcion" class="formulario__label">Descripcion </label>
				</p>
				<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4" id="grupo__descripcion">
				<p><label for="descripcion" class="formulario__label">Portada</label>
				</p><p>Ingrese una imagen ubicada en la carpeta de este proyecto, 'archivos' y seleccione alguna imagen de la subcarpeta 'Portadas'</p>
				<input type="file" class="form-control" name="imagen" id="imagen" required>
			</div>
		</div>
		<div class="botones">
			<button type="submit" name="enviar" id="idsubmit" value="ingresar" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
			<button class="btn btn-primary" type="reset" name="resetear" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>&nbsp;&nbsp;Limpiar</button>
			<a href="libro.php"><button class="btn btn-primary" type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>&nbsp;&nbsp;Volver</button></a>
		</div>
	</form>
</body>
</html>