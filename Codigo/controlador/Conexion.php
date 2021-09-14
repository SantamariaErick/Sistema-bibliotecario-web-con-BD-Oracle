<?php 
$conexion = oci_connect('BIBLIOTECA', 'bibliotecaweb', 'localhost/orcl');
if (!$conexion) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>