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
	$stid = oci_parse($conexion, "SELECT * FROM USUARIO where USU_ID = $id");
	
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
		<form name="form1" id="form1" method="post" action="editar_usuario_actualizar.php">
			<div class="cont-tabla">
			<?php
			//Mostramos los registros
			while ( $row = oci_fetch_array($stid) ) {
				?>
				<input type="hidden" value="<?php echo $row["USU_ID"]; ?>" name="id">
				<div class="row">
				
				<div class="form-dividido2 formulario__grupo" id="grupo__trabajador"><p><label for="trabajador" class="formulario__label">N# Trabajador</label></p>
				<input type="text" class="formulario__input" name="trabajador" id="trabajador" value="<?php echo $row[ "USU_TRABAJADOR" ]; ?>" placeholder="Ingrese el trabajador" required>
				</div>

				<div class="form-dividido2 formulario__grupo" id="grupo__cedula"><p><label for="cedula" class="formulario__label">Cedula </label></p>
				<input type="text" class="formulario__input" name="cedula" id="cedula" value="<?php echo $row[ "USU_CEDULA" ]; ?>" placeholder="Ingrese la cedula" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
				<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $row[ "USU_NOMBRE" ]; ?>" placeholder="Ingrese la nombre" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__profesion"><p><label for="profesion" class="formulario__label">Profesion </label></p>
				<input type="text" class="formulario__input" name="profesion" id="profesion" value="<?php echo $row[ "USU_PROFESION" ]; ?>" placeholder="Ingrese la profesion" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__cargo"><p><label for="cargo" class="formulario__label">Cargo </label></p>
				<input type="text" class="formulario__input" name="cargo" id="cargo" value="<?php echo $row[ "USU_CARGO" ]; ?>" placeholder="Ingrese la cargo" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__direccion"><p><label for="direccion" class="formulario__label">Direccion </label></p>
				<input type="text" class="formulario__input" name="direccion" id="direccion" value="<?php echo $row[ "USU_DIRECCION" ]; ?>" placeholder="Ingrese la direccion" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__telefono"><p><label for="telefono" class="formulario__label">Telefono </label></p>
				<input type="text" class="formulario__input" name="telefono" id="telefono" value="<?php echo $row[ "USU_TELEFONO" ]; ?>" placeholder="Ingrese la telefono" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__email"><p><label for="email" class="formulario__label">Email </label></p>
				<input type="text" class="formulario__input" name="email" id="email" value="<?php echo $row[ "USU_EMAIL" ]; ?>" placeholder="Ingrese la email" required>
				</div>
				
				<div class="form-dividido2 formulario__grupo" id="grupo__usuario"><p><label for="usuario" class="formulario__label">Usuario </label></p>
				<input type="text" class="formulario__input" name="usuario" id="usuario" value="<?php echo $row[ "USU_LOGIN" ]; ?>" placeholder="Ingrese la usuario" required>
				</div>

				</div>

				<?php
			}
				oci_free_statement($stid);   
			?>
			</div>
			<div class="opciones">
				<input type="submit" value="Actualizar">
				<a href="usuario.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
			</div>
		</form>
	</div>

</div>

</body>
</html>