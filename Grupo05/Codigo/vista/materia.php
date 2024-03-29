<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../public/css/estilo_paginasTabl.css" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<title>Documento sin título</title>
</head>

<body>
	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h1 class="box-title">Materias 	  
					  		<a href="formulario_materia.php" id="idcrear" >
					  		<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fas fa-plus-square"></i>&nbsp;Agregar</button></a></h1>
						</div>
						<div class="filtro">
							<form method="post" name="form1">
								<label for="filtro">Filtrar: </label>
								<select name="filtro" id="filtro" class="selectpicker">
									<option value="todos">Todos</option>
									<option value="activos">Activos</option>
									<option value="inctivos">Inactivos</option>
								</select>
								<input class="btn btn-primary btn-sm" type="submit" name="enviar" value="Consultar">
							</form>
						</div>
						<!-- /.box-header -->
						<!-- centro -->
						<div class="panel-body table-responsive" id="listadoregistros">
							<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>ID</th>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Estado</th>
									<th>Acciones</th>
								</thead>
								<tbody>

									<?php
									require( '../controlador/Conexion.php' );

									if ( isset( $_POST[ 'enviar' ] ) ) {
										$filtro = $_POST[ 'filtro' ];
										$ad = "";
										if ( $filtro == "todos" ) {
											$stid = oci_parse( $conexion, "select * from materia" );
											$ad = "Activar/Desactivar";
										} elseif ( $filtro == "activos" ) {
											$stid = oci_parse( $conexion, "select * from materia where mat_estado=1" );
											$ad = "Desactivar";
										} else {
											$stid = oci_parse( $conexion, "select * from materia where mat_estado=0" );
											$ad = "Activar";
										}
										oci_execute( $stid );
										while ( $row = oci_fetch_array( $stid ) ) {
											echo '<tr><td>' . $row[ "MAT_ID" ] . '</td>';
											echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
											echo '<td>' . $row[ "MAT_DESCRIPCION" ] . '</td>';
											echo '<td>' . $row[ "MAT_ESTADO" ] . '</td>';
											echo '<td> <a href="editar_materia_recibe.php?id=' . $row[ "MAT_ID" ] . '" title="Editar">Editar </a><a href="eliminar_materia.php?id=' . $row[ "MAT_ID" ] . '" title="Activar"  class="btn-eliminar-i">' . $ad . '</a></td></tr>';
										}
									}
									?>
								</tbody>
							</table>
						</div>
						<!--Fin centro -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->

	</div>
	<!-- /.content-wrapper -->
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
		function drawError() {
			var container = document.getElementById( 'output' );
			container.innerHTML = 'Bummer: there was an error!';
		}
		// handles the response, adds the html
		function drawOutput( responseText ) {
			var container = document.getElementById( 'output' );
			//container.innerHTML = responseText;
		}
		// helper function for cross-browser request object
		function getRequest( url, success, error ) {
			var req = false;
			try {
				// most browsers
				req = new XMLHttpRequest();
			} catch ( e ) {
				// IE
				try {
					req = new ActiveXObject( "Msxml2.XMLHTTP" );
				} catch ( e ) {
					// try an older version
					try {
						req = new ActiveXObject( "Microsoft.XMLHTTP" );
					} catch ( e ) {
						return false;
					}
				}
			}
			if ( !req ) return false;
			if ( typeof success != 'function' ) success = function () {};
			if ( typeof error != 'function' ) error = function () {};
			req.onreadystatechange = function () {
				if ( req.readyState == 4 ) {
					return req.status === 200 ?
						success( req.responseText ) : error( req.status );
				}
			}
			req.open( "GET", url, true );
			req.send( null );
			return req;
		}
	</script>


</body>
</html>