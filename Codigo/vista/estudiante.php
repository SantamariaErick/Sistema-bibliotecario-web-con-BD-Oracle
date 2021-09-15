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
	<!--Contenido-->
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h1 class="box-title">Estudiantes 	  
					  		<a href="formulario_estudiante.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fas fa-plus-square"></i>&nbsp;Agregar</button></a></h1>
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
									<th>Codigo</th>
									<th>Cedula</th>
									<th>Nombre</th>
									<th>Carrera Profesional</th>
									<th>Direccion</th>
									<th>Telefono</th>
									<th>Email</th>
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
											$stid = oci_parse( $conexion, "select * from estudiante" );
											$ad = "Activar/Desactivar";
										} elseif ( $filtro == "activos" ) {
											$stid = oci_parse( $conexion, "select * from estudiante where est_estado=1" );
											$ad = "Desactivar";
										} else {
											$stid = oci_parse( $conexion, "select * from estudiante where est_estado=0" );
											$ad = "Activar";
										}

										oci_execute( $stid );
										while ( $row = oci_fetch_array( $stid ) ) {
											echo '<tr><td>' . $row[ "EST_ID" ] . '</td>';
											echo '<td>' . $row[ "EST_CODIGO" ] . '</td>';
											echo '<td>' . $row[ "EST_CEDULA" ] . '</td>';
											echo '<td>' . $row[ "EST_NOMBRE" ] . '</td>';
											echo '<td>' . $row[ "EST_CARRERA" ] . '</td>';
											echo '<td>' . $row[ "EST_DIRECCION" ] . '</td>';
											echo '<td>' . $row[ "EST_TELEFONO" ] . '</td>';
											echo '<td>' . $row[ "EST_EMAIL" ] . '</td>';
											echo '<td>' . $row[ "EST_ESTADO" ] . '</td>';
											echo '<td> <a href="editar_estudiante_recibe.php?id=' . $row[ "EST_ID" ] . '" title="Editar">Editar </a><a href="eliminar_estudiante.php?id=' . $row[ "EST_ID" ] . '" title="Activar"  class="btn-eliminar-i">' . $ad . '</a></td></tr>';
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


</body>
</html>