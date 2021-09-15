<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulario</title>
	<link href="../public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../public/css/estilo_paginasTabl.css" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
	<form id="form1" name="form1" method="post" action="registro_materia.php">
		<h1 class="centrar titulo">Formulario materia</h1>
		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="nombre" class="formulario__label">Nombre </label>
				</p>
				<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<p><label for="descripcion" class="formulario__label">Descripcion </label>
				</p>
				<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" required>
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