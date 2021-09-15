<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<div class="contenido">
<div class="form-contenedor">
<form id="form1" name="form1" method="post" action="registro_autor.php">
	<h1 class="centrar titulo">Formulario autor</h1>
	
	<div class="row">
	<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
	<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingrese el nombre" required>
	</div>
	
	<div class="form-dividido2 formulario__grupo" id="grupo__descripcion"><p><label for="descripcion" class="formulario__label">Descripcion </label></p>
	<input type="text" class="formulario__input" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion" required>
	</div>
	
		<div class="form-dividido2 formulario__grupo" id="grupo__descripcion"><p><label for="descripcion" class="formulario__label">Imagen </label></p>
	<input type="file" class="formulario__input" name="imagen" id="imagen" required>
	</div>
	
	</div>


	<div class="row"><p class="centrar4">
		<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
		<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i>Restablecer</button>
		<div class="volver2"><a href="autores.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a></div>
	</div>
</form>
</div>
</div>
</body>
</html>