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
			$stid = oci_parse($conexion, "select * from usuario");
			oci_execute($stid);
		?>         
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                      <h1 class="box-title">Usuario 	  
					  <a href="formulario_usuario.php" id="idcrear" ><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></a></h1>
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
                            <th>Uuario</th>
                            <th>Acciones</th>
                            <th>ESTADO</th>
                          </thead>
                          <tbody>    
							  <?php
									while ( $row = oci_fetch_array($stid) ) {
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
										echo '<td> <a href="editar_usuario_recibe.php?id='.$row["USU_ID" ].'" title="Editar">Editar </a><a href="eliminar_usuario.php?id='.$row[ "USU_ID" ].'" title="Activar"  class="btn-eliminar-i">Borrar</a></td></tr>';
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
