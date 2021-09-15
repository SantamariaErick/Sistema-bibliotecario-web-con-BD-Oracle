<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Autores</title>
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../public/css/portadaImg.css" rel="stylesheet" type="text/css">
	<link href="../public/css/estilo_paginasTabl.css" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>

	<div class="content-wrapper">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h1 class="box-title">Autores 	  
					  		<a href="formulario_autor.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fas fa-plus-square"></i>&nbsp;Agregar</button></a></h1>
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
									<th>Descripcion</th>
									<th>Imagen</th>
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
											$stid = oci_parse( $conexion, "SELECT * FROM autor" );
											$ad = "Activar/Desactivar";
										} elseif ( $filtro == "activos" ) {
											$stid = oci_parse( $conexion, "SELECT * FROM autor where aut_estado=1" );
											$ad = "Desactivar";
										} else {
											$stid = oci_parse( $conexion, "SELECT * FROM autor where aut_estado=0" );
											$ad = "Activar";
										}

										if ( !$stid ) {
											$e = oci_error( $conexion );
											trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
										}

										// Realizar la lógica de la consulta
										$r = oci_execute( $stid );
										if ( !$r ) {
											$e = oci_error( $stid ); //Algun error al consultar
											trigger_error( htmlentities( $e[ 'message' ], ENT_QUOTES ), E_USER_ERROR );
										}
										while ( $row = oci_fetch_array( $stid ) ) {
											echo '<tr><td>' . $row[ "AUT_ID" ] . '</td>';
											echo '<td>' . $row[ "AUT_NOMBRE" ] . '</td>';
											echo '<td>' . $row[ "AUT_DESCRIPCION" ] . '</td>';
											echo '<td>' . '<img class="perfil" src="../archivos/Autores/' . $row[ "AUT_IMAGEN" ] . '">' . '</td>';
											echo '<td>' . $row[ "AUT_ESTADO" ] . '</td>';
											echo '<td> <a href="editar_autor.php?id=' . $row[ "AUT_ID" ] . '" title="Editar">Editar </a><a href="eliminar_autor.php?id=' . $row[ "AUT_ID" ] . '" title="Activar"  class="btn-eliminar-i">' . $ad . '</a></td></tr>';
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
</body>
</html>