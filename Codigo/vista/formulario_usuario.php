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
<div class="cabeza">Ingresar Usuario</div>
<div class="contenido">
<div class="form-contenedor">
<form id="form1" name="form1" method="post" action="registro_usuario.php">
	<h1 class="centrar titulo">Formulario usuario</h1>
	
	<div class="row">

	<div class="form-dividido2 formulario__grupo" id="grupo__trabajador"><p><label for="trabajador" class="formulario__label">Trabajador </label></p>
	<input type="text" class="formulario__input" name="trabajador" id="trabajador" placeholder="Ingrese el trabajador" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__cedula"><p><label for="cedula" class="formulario__label">Cédula </label></p>
	<input type="text" class="formulario__input" name="cedula" id="cedula" placeholder="Ingrese la cedula" onChange="validarCed()" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
	<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingrese la nombre" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__profesion"><p><label for="profesion" class="formulario__label">Profesion </label></p>
	<input type="text" class="formulario__input" name="profesion" id="profesion" placeholder="Ingrese la profesion" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__cargo"><p><label for="cargo" class="formulario__label">Cargo </label></p>
	<input type="text" class="formulario__input" name="cargo" id="cargo" placeholder="Ingrese la cargo" required>
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
	
	<div class="form-dividido2 formulario__grupo" id="grupo__login"><p><label for="login" class="formulario__label">Usuario </label></p>
	<input type="text" class="formulario__input" name="login" id="login" placeholder="Ingrese la usuario" required>
	</div>	
	
	<div class="form-dividido2 formulario__grupo" id="grupo__clave"><p><label for="clave" class="formulario__label">Clave </label></p>
	<input type="text" class="formulario__input" name="clave" id="clave" placeholder="Ingrese la clave" required>
	</div>	

	
	</div>


	<div class="row"><p class="centrar4">
		<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
		<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
		<div class="volver2"><a href="materia.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a></div>
	</div>
</form>
</div>
</div>
<script src="js/validaciones.js"></script>
</body>
</html>