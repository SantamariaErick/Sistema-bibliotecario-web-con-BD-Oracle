<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../public/css/estilo_pagPri.css" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
	<div class="wrapper">
		<div class="sidebar">
			<h2>Biblioteca</h2>
			<ul>
				<li><a href="prestamo.php" target="iframe_a"><i class="fas fa-home"></i>Préstamos</a>
				</li>
				<li><a href="libro.php" target="iframe_a"><i class="fas fa-book-open"></i>Libros</a>
				</li>
				<li><a href="autores.php" target="iframe_a"><i class="fas fa-user"></i>Autores</a>
				</li>
				<li><a href="editorial.php" target="iframe_a"><i class="fas fa-globe-americas"></i>Editoriales</a>
				</li>
				<li><a href="materia.php" target="iframe_a"><i class="fas fa-book"></i>Materias</a>
				</li>
				<li><a href="estudiante.php" target="iframe_a"><i class="fas fa-user"></i>Estudiantes</a>
				</li>
				<li><a href="usuario.php" target="iframe_a"><i class="fas fa-user"></i>Administrador</a>
				</li>
				<li><a href="auditoria.php" target="iframe_a"><i class="fas fa-user"></i>Auditoria</a>
				</li>
				<li><a href="acercade.html" target="iframe_a"><i class="fas fa-info-circle"></i>Acerca de</a>
				</li>
				<li><a href="../index.html" onclick="return getSuccessOutput();"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
				</li>

			</ul>
		</div>
		<div class="main_content">
			<div class="header">Sistema Bilbiotecario</div>
			<div class="ventana">
				<iframe title="description" name="iframe_a"></iframe>
			</div>
		</div>
	</div>
	
<script>

function getSuccessOutput() {
  getRequest(
      'cerrar_seseion.php',
       drawError
  );
  return true;
}

function drawError () {
    var container = document.getElementById('output');
    container.innerHTML = 'Bummer: there was an error!';
}

function drawOutput(responseText) {
    var container = document.getElementById('output');
   
}

function getRequest(url, success, error) {
    var req = false;
    try{
        req = new XMLHttpRequest();
    } catch (e){
        try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                return false;
            }
        }
    }
    if (!req) return false;
    if (typeof success != 'function') success = function () {};
    if (typeof error!= 'function') error = function () {};
    req.onreadystatechange = function(){
        if(req .readyState == 4){
            return req.status === 200 ? 
                success(req.responseText) : error(req.status)
            ;
        }
    }
    req.open("GET", url, true);
    req.send(null);
    return req;
}
</script> 


</body>
</html>