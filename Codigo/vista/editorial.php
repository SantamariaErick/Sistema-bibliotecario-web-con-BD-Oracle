<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>

	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h1 class="box-title">Editorial 	  
					  <a href="formulario_editorial.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></a></h1>
							<form method="post" name="form1">
								<label for="filtro">Filtrar: </label>
								<select name="filtro" id="filtro">
									<option value="todos">Todos</option>
									<option value="activos">Activos</option>
									<option value="inctivos">Inactivos</option>
								</select>
								<input type="submit" name="enviar" value="Consultar">
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
											$stid = oci_parse( $conexion, "SELECT * FROM editorial" );
											$ad = "Activar/Desactivar";
										} elseif ( $filtro == "activos" ) {
											$stid = oci_parse( $conexion, "SELECT * FROM editorial where edi_estado=1" );
											$ad = "Desactivar";
										} else {
											$stid = oci_parse( $conexion, "SELECT * FROM editorial where edi_estado=0" );
											$ad = "Activar";
										}
										$r = oci_execute( $stid );
										while ( $row = oci_fetch_array( $stid ) ) {
											echo '<tr><td>' . $row[ "EDI_ID" ] . '</td>';
											echo '<td>' . $row[ "EDI_NOMBRE" ] . '</td>';
											echo '<td>' . $row[ "EDI_DESCRIPCION" ] . '</td>';
											echo '<td>' . $row[ "EDI_ESTADO" ] . '</td>';
											echo '<td> <a href="editar_editorial.php?id=' . $row[ "EDI_ID" ] . '" title="Editar">Editar </a><a href="eliminar_editorial.php?id=' . $row[ "EDI_ID" ] . '" title="Activar"  class="btn-eliminar-i">' . $ad . '</a></td></tr>';
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