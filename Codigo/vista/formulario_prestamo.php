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
	<form id="form1" name="form1" method="post" action="registro_prestamo.php">
		<h1 class="centrar titulo">Formulario prestamo</h1>
		<div class="row">
			<div class="form-group col-md-2">
				<p><label for="id" class="formulario__label">ID </label>
				</p>
				<input type="number" class="form-control" name="id" id="id" placeholder="Ingrese el id">
			</div>
			<div class="form-group col-md-6">
				<p><label for="estudiante" class="formulario__label">Estudiante</label>
				</p>
				<p>
					<select name="estudiante" id="estudiante" class="form-control">
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
							echo '<option value = "' . $row[ 0 ] . '">' . $row[ 3 ] . ' con CI: ' . $row[ 2 ] . '</option>';
						}
						oci_free_statement( $stid );
						?>
					</select>
				</p>
			</div>
			<div class="form-group col-md-4">
				<p><label for="libro" class="formulario__label">Libro</label>
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
				<input type="date" class="form-control" name="fpresta" id="fpresta" required>
			</div>
			<div class="form-group col-md-4">
				<p>
					<label for="fdevol" >Fecha devolucion </label>
				</p>
				<input name="fdevol" type="date" required class="form-control" id="fdevol">
			</div>
			<div class="form-group col-md-4">
				<p><label for="cantidad" >Cantidad </label>
				</p>
				<input name="cantidad" type="number" required class="form-control" id="cantidad" max="30" min="0" step="1">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-10">
				<p><label for="observacion">Observaciones</label>
				</p>
				<input name="observacion" type="text" required class="form-control" id="observacion">
			</div>
			<div class="form-group col-md-2">
				<p><label for="condicion">Estado</label>
				</p>
				<p>
					<select name="condicion" id="condicion" class="form-control"	>
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
</body>
</html>