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
	<div class="contenido">
		<div class="form-contenedor">
			<form id="form1" name="form1" method="post">
				<h1 class="centrar titulo">Formulario editorial</h1>

				<div class="row">
					<div class="form-dividido2 formulario__grupo" id="grupo__id">
						<p><label for="id" class="formulario__label">ID</label>
						</p>
						<input type="number" class="formulario__input" name="id" id="id" placeholder="Ingrese el id" value="<?php echo $fila[0]?>" disabled>
					</div>
					<div class="form-dividido2 formulario__grupo" id="grupo__nombre">
						<p><label for="nombre" class="formulario__label">Nombre </label>
						</p>
						<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="<?php echo $fila[1]?>" required>
					</div>

					<div class="form-dividido2 formulario__grupo" id="grupo__descripcion">
						<p><label for="descripcion" class="formulario__label">Descripcion </label>
						</p>
						<input type="text" class="formulario__input" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" value="<?php echo $fila[2]?>" required>
					</div>

				</div>
				<div class="row">
					<p class="centrar4">
						<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
						<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
						<div class="volver2"><a href="editorial.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a>
						</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	if ( isset( $_POST[ 'enviar' ] ) )//Si detecta el boton de enviar 
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

		if ( $r ) {
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