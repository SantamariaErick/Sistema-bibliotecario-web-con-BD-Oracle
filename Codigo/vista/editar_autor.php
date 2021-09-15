<!doctype html >
	<html>
	<head>
		<meta charset="utf-8">
		<title>Documento sin título</title>
	</head>

	<body>
		<?php
		$id = $_GET[ 'id' ];
		require( '../controlador/Conexion.php' );

		$stid = oci_parse( $conexion, "SELECT * FROM AUTOR where AUT_ID = $id" );

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
					<h1 class="centrar titulo">Formulario autor</h1>

					<div class="row">
						<div class="form-dividido2 formulario__grupo" id="grupo__id">
							<p><label for="id" class="formulario__label">ID </label>
							</p>
							<input type="number" class="formulario__input" value="<?php echo $fila[0]?>" name="id" id="id" placeholder="Ingrese el id" disabled required>
						</div>
						<div class="form-dividido2 formulario__grupo" id="grupo__nombre">
							<p><label for="nombre" class="formulario__label">Nombre </label>
							</p>
							<input type="text" class="formulario__input" value="<?php echo $fila[1]?>" name="nombre" id="nombre" placeholder="Ingrese el nombre" required>
						</div>

						<div class="form-dividido2 formulario__grupo" id="grupo__descripcion">
							<p><label for="descripcion" class="formulario__label">Descripcion </label>
							</p>
							<input type="text" class="formulario__input" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" value="<?php echo $fila[2]?>" required>
						</div>

						<div class="form-dividido2 formulario__grupo" id="grupo__descripcion">
							<p><label for="descripcion" class="formulario__label">Imagen </label>
							</p>
							<input type="file" class="formulario__input" name="imagen" id="imagen">
						</div>

					</div>
					<div class="row">
						<p class="centrar4">
							<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
							<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
							<div class="volver2"><a href="autores.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a>
							</div>
					</div>
				</form>
			</div>
		</div>
	</body>
			<?php
	if ( isset( $_POST[ 'enviar' ] ) )//Si detecta el boton de enviar 
	{
		if(empty($_POST['imagen'])){//Si detecta una imagen guarda url, si no, guadra lo de la bd
			$imagen = $fila[3];
		}else{
			 $imagen = $_POST[ 'imagen' ];
		}
		$nombre = $_POST[ 'nombre' ];
		$descripcion = $_POST[ 'descripcion' ];
		
		$actualizar = "UPDATE AUTOR SET AUT_NOMBRE ='$nombre', AUT_DESCRIPCION='$descripcion', AUT_IMAGEN = '$imagen' WHERE AUT_ID = $id ";

		$stid = oci_parse( $conexion, $actualizar );

		if ( !$stid ) {
			$e = oci_error( $conexion );
			trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
		}

		// Realizar la lógica de la consulta
		$r = oci_execute( $stid );
/////////////////////////////////////////////////////////////////////////////////////////////////////
$stid_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
$r = oci_execute($stid_auditoria);
$row_auditoria = oci_fetch_array($stid_auditoria,OCI_ASSOC); 
session_start();
$user = $_SESSION['user'];

if($row_auditoria == 0){
	$query_auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES (1,$user,'Editó autor')";
	$stid_aud = oci_parse( $conexion, $query_auditoria );
	oci_execute( $stid_aud );
}else{
	
	$id_nuevo_auditoria = oci_parse($conexion, "Select * from AUDITORIA");
	$r2_auditoria = oci_execute($id_nuevo_auditoria);
	while ( $row_aud = oci_fetch_array( $id_nuevo_auditoria ) ) {
		$aux_auditoria = $row_aud['AUD_ID'];
	}
	
	$aux_auditoria = $aux_auditoria+1;
	$auditoria = "INSERT INTO AUDITORIA (AUD_ID, USU_ID, AUD_DESCRIPCION) VALUES ($aux_auditoria,$user,'Editó autor')";
	$stid2 = oci_parse( $conexion, $auditoria );
	oci_execute( $stid2 );
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
		if ( $r &&($stid_aud ||$stid2 ) ) {
			echo '<script>
				alert("Los datos se han actualizado correctamente");
				window.location="autores.php";
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
	</html>