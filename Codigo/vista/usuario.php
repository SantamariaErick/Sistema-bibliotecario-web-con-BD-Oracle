<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Profesión</th>
                            <th>Cargo</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Login</th>
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
