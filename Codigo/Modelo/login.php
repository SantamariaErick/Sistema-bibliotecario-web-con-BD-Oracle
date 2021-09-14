<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<?php
require('../controlador/Conexion.php');
$user = $_POST['usuario'];
$contra = $_POST['password'];
// Preparar la sentencia
$stid = oci_parse($conexion, "SELECT * FROM usuario where usu_login = '$user' and usu_clave='$contra'");
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
$row = oci_fetch_array($stid,OCI_ASSOC); 
if($row >0){
	echo '<script>window.alert("Clave y usuario correctos"); window.location="../index.html";</script>';
	//Aqui va un header('paginaPrincipal');
}
else{
	echo '<script>window.alert("Clave o usuario incorrectos. Ingrese nuevamente"); window.location="../index.html";</script>';
}

oci_free_statement($stid);
oci_close($conexion);

?>
</body>
</html>