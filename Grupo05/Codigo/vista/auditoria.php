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
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h1 class="box-title">Auditoria</h1>
						</div>
						<!-- /.box-header -->

						<!-- centro -->
						<div class="panel-body table-responsive" id="listadoregistros">
							<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Id</th>
									<th>Prestamo id</th>
									<th>Usuario id</th>
									<th>Descripcion</th>
								</thead>
								<tbody>
									<?php
									require( '../controlador/Conexion.php' );
										$stid = oci_parse( $conexion, "SELECT * FROM auditoria" );
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
											echo '<tr><td>' . $row[ "AUD_ID" ] . '</td>';
											echo '<td>' . $row[ "PRE_ID" ] . '</td>';
											echo '<td>' . $row[ "USU_ID" ] . '</td>';
											echo '<td>' . $row[ "AUD_DESCRIPCION" ] . '</td></tr>';
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