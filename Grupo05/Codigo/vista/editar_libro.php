<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../public/css/estilo_paginasTabl.css" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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

	<form id="form1" name="form1" method="post">
		<h1 class="centrar titulo">Formulario libro</h1>

		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="materia" class="formulario__label">Materia</label>
				</p>
				<p>
					<select name="materia" id="materia" class="form-control">
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
				<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="<?php echo $fila[4]?>" required>
			</div>
			<div class="form-group col-md-4">
				<p>
					<label for="cantidadDisp" class="formulario__label">Cantidad disponible </label>
				</p>
				<input name="cantidadDisp" value="<?php echo $fila[5]?>" type="number" required class="form-control" id="cantidadDisp" min="0" step="1">
			</div>
			<div class="form-group col-md-4">
				<p><label for="anioEd" class="formulario__label">Año de edición </label>
				</p>
				<input name="anioEd" type="number" required class="form-control" id="anioEd" max="2021" value="<?php echo $fila[6]?>" min="0" step="1">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="cantidadPag" class="formulario__label">Cantidad de páginas </label>
				</p>
				<input name="cantidadPag" value="<?php echo $fila[7]?>" type="number" required class="form-control" id="cantidadPag" min="1" step="1">
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
				<input name="peso" value="<?php echo $fila[9]?>" type="number" required class="form-control" id="peso" min="0" step="0.01">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<p><label for="descripcion" class="formulario__label">Descripcion </label>
				</p>
				<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" value="<?php echo $fila[10]?>" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4" id="grupo__descripcion">
				<p><label for="descripcion" class="formulario__label">Portada</label>
				</p>
				<input type="file" class="form-control" name="imagen" id="imagen">
			</div>
		</div>
		<div class="botones">
			<button type="submit" name="enviar" id="idsubmit" value="ingresar" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
			<button class="btn btn-primary" type="reset" name="resetear" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>&nbsp;&nbsp;Limpiar</button>
			<a href="libro.php"><button class="btn btn-primary" type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>&nbsp;&nbsp;Volver</button></a>
		</div>
	</form>







	<?php
	if ( isset( $_POST[ 'enviar' ] ) ) //Si detecta el boton de enviar 
	{
		if ( empty( $_POST[ 'imagen' ] ) ) { //Si detecta una imagen guarda url, si no, guadra lo de la bd
			$imagen = $fila[ 11 ];
		} else {
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
			/////////////////////////////////////////////////////////////////////////////////////////////////////
			$stid_auditoria = oci_parse( $conexion, "Select * from AUDITORIA order by AUD_ID asc" );
			$r = oci_execute( $stid_auditoria );
			$row_auditoria = oci_fetch_array( $stid_auditoria, OCI_ASSOC );
			session_start();
			$user = $_SESSION[ 'user' ];

			if ( $row_auditoria == 0 ) {
				$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Actualizo libro')";
				$stid_aud = oci_parse( $conexion, $query_auditoria );
				oci_execute( $stid_aud );
			} else {

				$id_nuevo_auditoria = oci_parse( $conexion, "Select * from AUDITORIA order by AUD_ID asc" );
				$r2_auditoria = oci_execute( $id_nuevo_auditoria );
				while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
					$aux_auditoria = $row_aud[ 'AUD_ID' ];
				}

				$aux_auditoria = $aux_auditoria + 1;
				$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Actualizo libro')";
				$stid2 = oci_parse( $conexion, $auditoria );
				oci_execute( $stid2 );
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////


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