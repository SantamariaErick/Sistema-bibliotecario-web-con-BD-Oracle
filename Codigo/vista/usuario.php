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
							<h1 class="box-title">Usuarios 	  
					  		<a href="formulario_libro.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fas fa-plus-square"></i>&nbsp;Agregar</button></a></h1>
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
									<th>N° Trabajador</th>
									<th>Cedula</th>
									<th>Nombre</th>
									<th>Profesión</th>
									<th>Cargo</th>
									<th>Direccion</th>
									<th>Telefono</th>
									<th>Email</th>
									<th>Usuario</th>
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
											$stid = oci_parse( $conexion, "select * from usuario" );
											$ad = "Activar/Desactivar";
										} elseif ( $filtro == "activos" ) {
											$stid = oci_parse( $conexion, "select * from usuario where usu_estado=1" );
											$ad = "Desactivar";
										} else {
											$stid = oci_parse( $conexion, "select * from usuario where usu_estado=0" );
											$ad = "Activar";
										}

										oci_execute( $stid );
										while ( $row = oci_fetch_array( $stid ) ) {
											echo '<tr><td>' . $row[ "USU_ID" ] . '</td>';
											echo '<td>' . $row[ "USU_TRABAJADOR" ] . '</td>';
											echo '<td>' . $row[ "USU_CEDULA" ] . '</td>';
											echo '<td>' . $row[ "USU_NOMBRE" ] . '</td>';
											echo '<td>' . $row[ "USU_PROFESION" ] . '</td>';
											echo '<td>' . $row[ "USU_CARGO" ] . '</td>';
											echo '<td>' . $row[ "USU_DIRECCION" ] . '</td>';
											echo '<td>' . $row[ "USU_TELEFONO" ] . '</td>';
											echo '<td>' . $row[ "USU_EMAIL" ] . '</td>';
											echo '<td>' . $row[ "USU_LOGIN" ] . '</td>';
											echo '<td>' . $row[ "USU_ESTADO" ] . '</td>';
											echo '<td> <a href="editar_usuario_recibe.php?id=' . $row[ "USU_ID" ] . '" title="Editar">Editar </a><a href="eliminar_usuario.php?id=' . $row[ "USU_ID" ] . '" title="Activar"  class="btn-eliminar-i">' . $ad . '</a></td></tr>';
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