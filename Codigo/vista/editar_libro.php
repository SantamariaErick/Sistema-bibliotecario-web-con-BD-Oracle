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

	$stid = oci_parse( $conexion, "SELECT * FROM LIBRO where LIB_ID = $id" );

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
			<form id="form1" name="form1" method="post" >
				<h1 class="centrar titulo">Formulario libro</h1>

				<div class="row">
					<div class="form-dividido2 formulario__grupo" id="grupo__id">
						<p><label for="id" class="formulario__label">ID </label>
						</p>
						<input type="number" class="formulario__input" name="id" id="id" placeholder="Ingrese el id" value="<?php echo $fila[0]?>" disabled>
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="materia" class="formulario__label">Materia</label>
						</p>
						<p>
							<select name="materia" id="materia">
								<?php
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
						<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="<?php echo $fila[4]?>" required>
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p>
							<label for="cantidadDisp" class="formulario__label">Cantidad disponible </label>
						</p>
						<input name="cantidadDisp" type="number" required class="formulario__input" id="cantidadDisp" min="0" step="1" value="<?php echo $fila[5]?>">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="anioEd" class="formulario__label">Año de edición </label>
						</p>
						<input name="anioEd" type="number" required class="formulario__input" id="anioEd" max="2021" min="0" value="<?php echo $fila[6]?>" step="1">
					</div>
					<div class="form-dividido2 formulario__grupo">
						<p><label for="cantidadPag" class="formulario__label">Cantidad de páginas </label>
						</p>
						<input name="cantidadPag" type="number" value="<?php echo $fila[7]?>" required class="formulario__input" id="cantidadPag" min="1" step="1">
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
						<input name="peso" value="<?php echo $fila[9]?>" type="number" required class="formulario__input" id="peso" min="0" step="0.01">
					</div>
					<div class="form-dividido2 formulario__grupo" id="grupo__descripcion">
						<p><label for="descripcion" class="formulario__label">Descripcion </label>
						</p>
						<input value="<?php echo $fila[10]?>" type="text" class="formulario__input" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" required>
					</div>

					<div class="form-dividido2 formulario__grupo" id="grupo__descripcion">
						<p><label for="descripcion" class="formulario__label">Cambiar portada</label>
						</p>
						<input type="file" class="formulario__input" name="imagen" id="imagen">
					</div>
				</div>
				<div class="row">
					<p class="centrar4">
						<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
						<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
						<div class="volver2"><a href="libro.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a>
						</div>
					</p>
				</div>
			</form>
		</div>
	</div>
	<?php
	if ( isset( $_POST[ 'enviar' ] ) )//Si detecta el boton de enviar 
	{
		if(empty($_POST['imagen'])){//Si detecta una imagen guarda url, si no, guadra lo de la bd
			$imagen = $fila[11];
		}else{
			 $imagen = $_POST[ 'imagen' ];
		}
		$mat = $_POST[ 'materia' ];
		$edito = $_POST[ 'editorial' ];
		$autor = $_POST[ 'autor' ];
		$titulo = $_POST[ 'nombre' ];
		$cantidadDisp = $_POST[ 'cantidadDisp' ];
		$anioEd = $_POST[ 'anioEd' ];
		$cantidadPag = $_POST[ 'cantidadPag' ];
		$formato = $_POST[ 'formato' ];
		$peso = $_POST[ 'peso' ];
		$descripcion = $_POST[ 'descripcion' ];
		
		$actualizar = "UPDATE LIBRO SET MAT_ID =$mat, EDI_ID=$edito, AUT_ID = $autor, LIB_TITULO = '$titulo', LIB_CANTIDADDISPONIBLE = $cantidadDisp, LIB_ANIOEDICION = '$anioEd', LIB_CANTIDADPAGINAS = $cantidadPag, LIB_FORMATO = '$formato', LIB_PESO = $peso,LIB_DESCRIPCION='$descripcion',LIB_PORTADA='$imagen' WHERE LIB_ID = $id ";

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
				window.location="libro.php";
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