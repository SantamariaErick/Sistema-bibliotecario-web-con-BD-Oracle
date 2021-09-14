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
	
	$stid = oci_parse($conexion, "SELECT * FROM ESTUDIANTE where EST_ID = $id");
	
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
		<form name="form1" id="form1" method="post" action="editar_estdiante_actualizar.php">
			<div class="cont-tabla">
			<?php
			//Mostramos los registros
			while ( $row = oci_fetch_array($stid) ) {
				?>
				<input type="hidden" value="<?php echo $row["EST_ID"]; ?>" name="id">
				<div class="row">

				<div class="form-dividido2 formulario__grupo" id="grupo__codigo"><p><label for="codigo" class="formulario__label">CODIGO </label></p>
				<input type="text" class="formulario__input" name="codigo" id="codigo" value="<?php echo $row[ "EST_CODIGO" ]; ?>" placeholder="Ingrese el nomcodigobre" required>
				</div>

				<div class="form-dividido2 formulario__grupo" id="grupo__cedula"><p><label for="cedula" class="formulario__label">CEDULA </label></p>
				<input type="text" class="formulario__input" name="cedula" id="cedula" value="<?php echo $row[ "EST_CEDULA" ]; ?>" placeholder="Ingrese la cedula" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__Nombre"><p><label for="Nombre" class="formulario__label">Nombre </label></p>
				<input type="text" class="formulario__input" name="Nombre" id="Nombre" value="<?php echo $row[ "EST_NOMBRE" ]; ?>" placeholder="Ingrese la Nombre" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__carrera"><p><label for="carrera" class="formulario__label">Carrera </label></p>
				<input type="text" class="formulario__input" name="carrera" id="carrera" value="<?php echo $row[ "EST_CARRERA" ]; ?>" placeholder="Ingrese la carrera" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__direccion"><p><label for="direccion" class="formulario__label">Direccion </label></p>
				<input type="text" class="formulario__input" name="direccion" id="direccion" value="<?php echo $row[ "EST_DIRECCION" ]; ?>" placeholder="Ingrese la direccion" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__telefono"><p><label for="telefono" class="formulario__label">Telefono </label></p>
				<input type="text" class="formulario__input" name="telefono" id="telefono" value="<?php echo $row[ "EST_TELEFONO" ]; ?>" placeholder="Ingrese la telefono" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__email"><p><label for="email" class="formulario__label">Email </label></p>
				<input type="text" class="formulario__input" name="email" id="email" value="<?php echo $row[ "EST_EMAIL" ]; ?>" placeholder="Ingrese la email" required>
				</div>

				</div>

				<?php
			}
				oci_free_statement($stid);   
			?>
			</div>
			<div class="opciones">
				<input type="submit" value="Actualizar">
				<a href="estudiante.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
			</div>
		</form>
	</div>

</div>

</body>
</html>