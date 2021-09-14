<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Autores</title>
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../public/css/portadaImg.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
		require( '../controlador/Conexion.php' );
		$stid = oci_parse( $conexion, "SELECT * FROM autor" );
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
							<h1 class="box-title">Autores	  
					  <a href="formulario_libro.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></a></h1>
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
									<th>Acciones</th>
								</thead>
								<tbody>
									<?php
									while ( $row = oci_fetch_array( $stid ) ) {
										echo '<tr><td>' . $row[ "AUT_ID" ] . '</td>';
										echo '<td>' . $row[ "AUT_NOMBRE" ] . '</td>';
										echo '<td>' . $row[ "AUT_DESCRIPCION" ] . '</td>';
										echo '<td>' . '<img class="perfil" src="../archivos/Autores/' . $row[ "AUT_IMAGEN" ] . '">' . '</td>';
										echo '<td> <a href="editar_autor.php?id='.$row["AUT_ID" ].'" title="Editar">Editar </a><a href="eliminar_autor.php?id='.$row[ "AUT_ID" ].'" title="Activar"  class="btn-eliminar-i">Borrar</a></td></tr>';
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