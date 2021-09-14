<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link href="../public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<title>Documento sin título</title>
</head>

<body>
	<h3>Prestamo</h3>
	<div><a><input type="button" value="Prestar"></a></div>
	<?php
	require('../controlador/Conexion.php');
	$stid = oci_parse($conexion, "SELECT * FROM prestamo p, estudiante e, libro l where p.est_id=e.est_id and p.lib_id = l.lib_id");
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
			<th>Estudiante</th>
			<th>Libro</th>
			<th>Fecha prestado</th>
			<th>Fecha devuelto</th>
			<th>Cantidad</th>
			<th>Observaciones</th>
			<th>Estado</th>
		</tr>
		</thead>
	<?php
		while ( $row = oci_fetch_array($stid) ) {
			echo '<tr><td>' . $row[ "EST_NOMBRE" ] . '</td>';
			echo '<td>' . $row[ "LIB_TITULO" ] . '</td>';
			echo '<td>' . $row[ "PRE_FECHAPRESTADO" ] . '</td>';
			echo '<td>' . $row[ "PRE_FECHADEVUELTO" ] . '</td>';
			echo '<td>' . $row[ "PRE_CANTIDAD" ] . '</td>';
			echo '<td>' . $row[ "PRE_OBSERVACIONES" ] . '</td>';
			echo '<td>' . $row[ "PRE_ESTADO" ] . '</td></tr>';
		}
	?>
		</table>
	
</body>
</html>