<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<title>Documento sin título</title>
</head>

<body>
<!--Contenido-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<?php
		$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');
		//Ejecutamos la sentencia SQL
		$stid = oci_parse($conexion, "select * from estudiante");
		oci_execute($stid);
	?>        
	<!-- Main content -->
	<section class="content">
		<div class="row">
		  <div class="col-md-12">
			  <div class="box">
				<div class="box-header with-border">
					  <h1 class="box-title">Estudiante 	  
					  <a href="formulario_estudiante.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></a></h1>
					  
					<div class="box-tools pull-right">
					</div>
				</div>
				<!-- /.box-header -->
				<!-- centro -->
				<div class="panel-body table-responsive" id="listadoregistros">
					<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
					  <thead>
						<th>Opciones</th>
						<th>Codigo</th>
						<th>DNI</th>
						<th>Nombre</th>
						<th>Carrera Profesional</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Condición</th>
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


</body>
</html>


