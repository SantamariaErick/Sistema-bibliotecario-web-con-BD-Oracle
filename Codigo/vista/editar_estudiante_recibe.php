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
	$row = oci_fetch_array($stid);

	?>
	
	<form id="form1" name="form1" method="post" action="editar_estudiante_actualizar.php">
	<input type="hidden" value="<?php echo $id;?>" name="id">
	<h1 class="centrar titulo">Formulario estudiante</h1>
	<div class="row">
	<div class="form-group col-md-4"><p><label for="codigo" class="formulario__label">Código </label></p>
	<input value="<?php echo $row[ 'EST_CODIGO' ]; ?>" type="text" class="form-control" name="codigo" id="codigo" placeholder="Ingrese el codigo" required>
	</div>
	
	<div class="form-group col-md-4"><p><label for="cedula" class="formulario__label">Cédula </label></p>
	<input type="text" value="<?php echo $row[ 'EST_CEDULA' ]; ?>" class="form-control" name="cedula" id="cedula" placeholder="Ingrese la cedula" onChange="validarCed()" required>
	</div>
	
	<div class="form-group col-md-4"><p><label for="nombre" class="formulario__label">Nombre </label></p>
	<input value="<?php echo $row[ 'EST_NOMBRE' ]; ?>" type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese la nombre" required>
	</div></div>
	<div class="row">
	<div class="form-group col-md-12" id="grupo__carrera"><p><label for="carrera" class="formulario__label">Carrera </label></p>
	<input value="<?php echo $row[ 'EST_CARRERA' ]; ?>" type="text" class="form-control" name="carrera" id="carrera" placeholder="Ingrese la carrera" required>
	</div></div>
	<div class="row">
	<div class="form-group col-md-12"><p><label for="direccion" class="formulario__label">Dirección </label></p>
	<input value="<?php echo $row[ 'EST_DIRECCION' ]; ?>" type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese la direccion" required>
	</div></div>
	<div class="row">
	<div class="form-group col-md-6" id="grupo__telefono"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
	<input value="<?php echo $row[ 'EST_TELEFONO' ]; ?>" type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese la telefono" required>
	</div>
	
	<div class="form-group col-md-6" id="grupo__email"><p><label for="email" class="formulario__label">E-mail </label></p>
	<input value="<?php echo $row[ "EST_EMAIL" ]; ?>" type="email" class="form-control" name="email" id="email" placeholder="Ingrese la email" required>
	</div></div>

	<div class="botones">
			<button type="submit" name="enviar" id="idsubmit" value="ingresar" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
			<button class="btn btn-primary" type="reset" name="resetear" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>&nbsp;&nbsp;Limpiar</button>
			<a href="estudiante.php"><button class="btn btn-primary" type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>&nbsp;&nbsp;Volver</button></a>
		</div>
</form>
<script src="javascript/funciones.js"></script>
</body>
</html>