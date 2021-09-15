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
<form id="form1" name="form1" method="post" action="registro_usuario.php">
	<h1 class="centrar titulo">Formulario usuario</h1>
	
	<div class="row">

	<div class="form-group col-md-4"><p><label for="trabajador" class="formulario__label">Trabajador código </label></p>
	<input type="text" class="form-control" name="trabajador" id="trabajador" placeholder="Ingrese el trabajador" required>
	</div>
	
	<div class="form-group col-md-4"><p><label for="cedula" class="formulario__label">Cédula </label></p>
	<input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingrese la cedula" onChange="validarCed()" required>
	</div>
	
	<div class="form-group col-md-4"><p><label for="nombre" class="formulario__label">Nombre </label></p>
	<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese la nombre" required>
	</div>
	</div>
	<div class="row">
	<div class="form-group col-md-6"><p><label for="profesion" class="formulario__label">Profesión </label></p>
	<input type="text" class="form-control" name="profesion" id="profesion" placeholder="Ingrese la profesion" required>
	</div>
	
	<div class="form-group col-md-6"><p><label for="cargo" class="formulario__label">Cargo </label></p>
	<input type="text" class="form-control" name="cargo" id="cargo" placeholder="Ingrese la cargo" required>
	</div>	
	</div>
	<div class="row">
	<div class="form-group col-md-12" id="grupo__direccion"><p><label for="direccion" class="formulario__label">Dirección </label></p>
	<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese la direccion" required>
	</div></div>	
	<div class="row">
	<div class="form-group col-md-6"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
	<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese la telefono" required>
	</div>	
	<div class="form-group col-md-6"><p><label for="email" class="formulario__label">Email </label></p>
	<input type="text" class="form-control" name="email" id="email" placeholder="Ingrese la email" required>
	</div>	</div>	
	<div class="row">
	<div class="form-group col-md-6"><p><label for="login" class="formulario__label">Usuario </label></p>
	<input type="text" class="form-control" name="login" id="login" placeholder="Ingrese la usuario" required>
	</div>	
	
	<div class="form-group col-md-6"><p><label for="clave" class="formulario__label">Clave </label></p>
	<input type="text" class="form-control" name="clave" id="clave" placeholder="Ingrese la clave" required>
	</div></div>	
	
	<div class="botones">
			<button type="submit" name="enviar" id="idsubmit" value="ingresar" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
			<button class="btn btn-primary" type="reset" name="resetear" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>&nbsp;&nbsp;Limpiar</button>
			<a href="usuario.php"><button class="btn btn-primary" type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>&nbsp;&nbsp;Volver</button></a>
		</div>
</form>
</body>
</html>