<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<title>Documento sin título</title>
</head>

<body>
	<?php
	require( '../controlador/Conexion.php' );
	$stid = oci_parse( $conexion, "SELECT * FROM prestamo p, estudiante e, libro l where p.est_id=e.est_id and p.lib_id = l.lib_id" );
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
	?>
	<div class="content-wrapper">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h1 class="box-title">Prestamos 	  
					  <a href="formulario_usuario.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></a></h1>
						</div>
						<!-- /.box-header -->
						<!-- centro -->
						<div class="panel-body table-responsive" id="listadoregistros">
							<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Estudiante</th>
									<th>Libro</th>
									<th>Fecha prestado</th>
									<th>Fecha devuelto</th>
									<th>Cantidad</th>
									<th>Observaciones</th>
									<th>Estado</th>
								</thead>
								<tbody>
									<?php
									while ( $row = oci_fetch_array( $stid ) ) {
										echo '<tr><td>' . $row[ "EST_NOMBRE" ] . '</td>';
										echo '<td>' . $row[ "LIB_TITULO" ] . '</td>';
										echo '<td>' . $row[ "PRE_FECHAPRESTADO" ] . '</td>';
										echo '<td>' . $row[ "PRE_FECHADEVUELTO" ] . '</td>';
										echo '<td>' . $row[ "PRE_CANTIDAD" ] . '</td>';
										echo '<td>' . $row[ "PRE_OBSERVACIONES" ] . '</td>';
										echo '<td>' . $row[ "PRE_ESTADO" ] . '</td></tr>';
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