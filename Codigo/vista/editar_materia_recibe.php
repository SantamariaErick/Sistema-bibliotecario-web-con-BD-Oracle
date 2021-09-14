<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenedor2">
	<div class="cabeza">Editar Materia</div>
	<?php
	$id = $_GET['id'];
	require('../controlador/Conexion.php');
	$stid = oci_parse($conexion, "SELECT * FROM MATERIA where MAT_ID = $id");
	
	if (!$stid) {
		$e = oci_error($conexion);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// Realizar la lógica de la consulta
	$r = oci_execute($stid);
	if (!$r) {
		$e = oci_error($stid);//Algun error al consultar
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	//echo $id;
	?>
	
	<div class="cuerpo2">
		<form name="form1" id="form1" method="post" action="editar_materia_actualizar.php">
			<div class="cont-tabla">
			<?php
			//Mostramos los registros
			while ( $row = oci_fetch_array($stid) ) {
				?>
				<input type="hidden" value="<?php echo $row["MAT_ID"]; ?>" name="id">
				<div class="row">
				<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
				<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $row[ "MAT_NOMBRE" ]; ?>" placeholder="Ingrese el nombre" required>
				</div>

				<div class="form-dividido2 formulario__grupo" id="grupo__descripcion"><p><label for="descripcion" class="formulario__label">Descripcion </label></p>
				<input type="text" class="formulario__input" name="descripcion" id="descripcion" value="<?php echo $row[ "MAT_DESCRIPCION" ]; ?>" placeholder="Ingrese la descripcion" required>
				</div>

				</div>

				<?php
			}
				oci_free_statement($stid);   
			?>
			</div>
			<div class="opciones">
				<input type="submit" value="Actualizar">
				<a href="materia.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
			</div>
		</form>
	</div>

</div>

</body>
</html>