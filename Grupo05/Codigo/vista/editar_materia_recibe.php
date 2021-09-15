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
	$stid = oci_parse( $conexion, "SELECT * FROM MATERIA where MAT_ID = $id" );

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
	$row = oci_fetch_array( $stid )
	//echo $id;
	?>
	
	<form id="form1" name="form1" method="post" action="editar_materia_actualizar.php">
		<input type="hidden" name="id" value="<?php echo $id?>">
		<h1 class="centrar titulo">Formulario materia</h1>
		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="nombre" class="formulario__label">Nombre </label>
				</p>
				<input value="<?php echo $row[ 'MAT_NOMBRE' ]; ?>" type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="descripcion" class="formulario__label">Descripcion </label>
				</p>
				<input value="<?php echo $row[ 'MAT_DESCRIPCION' ]; ?>" type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" required>
			</div>
		</div>
		<div class="botones">
			<button type="submit" name="enviar" id="idsubmit" value="ingresar" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
			<button class="btn btn-primary" type="reset" name="resetear" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>&nbsp;&nbsp;Limpiar</button>
			<a href="materia.php"><button class="btn btn-primary" type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>&nbsp;&nbsp;Volver</button></a>
		</div>
	</form>
	
</body>
</html>