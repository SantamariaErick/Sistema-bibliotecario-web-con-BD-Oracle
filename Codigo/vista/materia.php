<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

	<div class="content-wrapper">
   		<?php
			$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');
			//Ejecutamos la sentencia SQL
			$stid = oci_parse($conexion, "select * from materia");
			oci_execute($stid);
		?>

    	<section class="content">
			<div class="row">
			  <div class="col-md-12">
				  <div class="box">
					<div class="box-header with-border">
						  <h1 class="box-title">Materia 
						  
						  <a href="formulario_materia.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></a></h1>
						<div class="box-tools pull-right">
						</div>
					</div>
					<!-- /.box-header -->
					<!-- centro -->
					<div class="panel-body table-responsive" id="listadoregistros">
						<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
						  <thead>
							<th>Opciones</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Estado</th>
						  </thead>
						  <tbody>
						  
					      <?php
								while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
									echo "<tr>\n";
									foreach ($fila as $elemento) {
										echo "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
									}
									echo "</tr>\n";
								} 
						  ?>
                                                            
						  </tbody>
						</table>
					</div>

					<!--Fin centro -->
				  </div><!-- /.box -->
			  </div><!-- /.col -->
			 </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  
<script>
	// handles the click event for link 1, sends the query
	function getSuccessOutput() {
	  getRequest(
		  'Myajax.php', // demo-only URL
		   drawError
	  );
	  return true;
	}

	// handles drawing an error message
	function drawError () {
		var container = document.getElementById('output');
		container.innerHTML = 'Bummer: there was an error!';
	}
	// handles the response, adds the html
	function drawOutput(responseText) {
		var container = document.getElementById('output');
		//container.innerHTML = responseText;
	}
	// helper function for cross-browser request object
	function getRequest(url, success, error) {
		var req = false;
		try{
			// most browsers
			req = new XMLHttpRequest();
		} catch (e){
			// IE
			try{
				req = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				// try an older version
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
