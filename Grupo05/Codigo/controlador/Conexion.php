<?php 
$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');
if (!$conexion) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

function ejecutarConsulta($query){
	$stmt = oci_parse($conexion, $query); // Preparar la sentencia
    $ok = oci_execute( $stmt );         // Ejecutar la sentencia
    oci_free_statement($stmt);          // Liberar los recursos asociados a una sentencia o cursor
    return $ok;
}

?>