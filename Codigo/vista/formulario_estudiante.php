<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario</title>
<link href="css/estiloform.css" rel="stylesheet" type="text/css">
<link href="css/estilohtmls.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="cabeza">Ingresar Materio</div>
<div class="contenido">
<div class="form-contenedor">
<form id="form1" name="form1" method="post" action="registro_estudiante.php">
	<h1 class="centrar titulo">Formulario estudiante</h1>
	
	<div class="row">

	<div class="form-dividido2 formulario__grupo" id="grupo__codigo"><p><label for="codigo" class="formulario__label">Codigo </label></p>
	<input type="text" class="formulario__input" name="codigo" id="codigo" placeholder="Ingrese el codigo" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__cedula"><p><label for="cedula" class="formulario__label">Cedula </label></p>
	<input type="text" class="formulario__input" name="cedula" id="cedula" placeholder="Ingrese la cedula" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
	<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingrese la nombre" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__carrera"><p><label for="carrera" class="formulario__label">Carrera </label></p>
	<input type="text" class="formulario__input" name="carrera" id="carrera" placeholder="Ingrese la carrera" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__direccion"><p><label for="direccion" class="formulario__label">Direccion </label></p>
	<input type="text" class="formulario__input" name="direccion" id="direccion" placeholder="Ingrese la direccion" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__telefono"><p><label for="telefono" class="formulario__label">Telefono </label></p>
	<input type="text" class="formulario__input" name="telefono" id="telefono" placeholder="Ingrese la telefono" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__email"><p><label for="email" class="formulario__label">Email </label></p>
	<input type="text" class="formulario__input" name="email" id="email" placeholder="Ingrese la email" required>
	</div>
	
	</div>


	<div class="row"><p class="centrar4">
		<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
		<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
		<div class="volver2"><a href="estudiante.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a></div>
	</div>
</form>
</div>
</div>
<script src="js/validaciones.js"></script>
</body>
</html>