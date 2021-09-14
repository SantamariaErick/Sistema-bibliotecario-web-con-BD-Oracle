<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h3>Editorial</h3>
	<div><a href="formulario_editorial.php"><input type="button" value="Agregar"></a></div>
	<?php
	require('../controlador/Conexion.php');
	$stid = oci_parse($conexion, "SELECT * FROM editorial");
	if (!$stid) {
		$e = oci_error($conexion);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// Realizar la lógica de la consulta
	$r = oci_execute($stid);
	if (!$r) {
		$e = oci_error($stid);//Algun error al consultar
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	//comprobar datos de la consulta
	 
	?>
	<table  class="table table-striped">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Condicion</th>
		</tr>
		</thead>
	<?php
		while ( $row = oci_fetch_array($stid) ) {
			echo '<tr><td>' . $row[ "EDI_NOMBRE" ] . '</td>';
			echo '<td>' . $row[ "EDI_DESCRIPCION" ] . '</td>';
			echo '<td>' . $row[ "EDI_CONDICION" ] . '</td></tr>';
		}
	?>
		</table>
	
</body>
</html>