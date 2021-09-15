<?php
require('../controlador/Conexion.php');
$id = $_POST[ 'id' ];
$nombre = $_POST[ 'nombre' ];
$descripcion = $_POST[ 'descripcion' ];
$estado = 1;

$editorial = oci_parse($conexion, "Select * from EDITORIAL");
$r = oci_execute($editorial);
$row_ini = oci_fetch_array($editorial,OCI_ASSOC);


if($row_ini == 0){
	$query =  "INSERT INTO editorial(edi_id,edi_nombre, edi_descripcion,edi_estado) VALUES (1,'$nombre','$descripcion',$estado)";
	
	$stid = oci_parse( $conexion, $query );
	oci_execute( $stid );
}else{
	
	$id_nuevo = oci_parse($conexion, "Select * from EDITORIAL");
	$r2 = oci_execute($id_nuevo);
	while ( $row = oci_fetch_array( $id_nuevo ) ) {
		$aux = $row['EDI_ID'];
	}
	
	$aux = $aux+1;
	
	$query = "INSERT INTO editorial(edi_id,edi_nombre, edi_descripcion,edi_estado) VALUES ($aux,'$nombre','$descripcion',$estado)";
	$stid = oci_parse( $conexion, $query );
	$ok = oci_execute( $stid );

}


if ( $ok ) {
	echo '<script>window.alert("Los datos se han guardado exitosamente");
		window.location="editorial.php";</script>';
} else {
	echo "<script>window.alert('Error al ingresar los datos');window.history.go(-1);</script>";
}
oci_free_statement($stid); 
?>