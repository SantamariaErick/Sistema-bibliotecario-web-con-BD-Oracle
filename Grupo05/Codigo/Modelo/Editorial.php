<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<?php 
require "../controlador/Conexion.php";

class Editorial
{
	public function __construct(){}

	//Insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO editorial (edi_nombre,edi_descripcion,edi_condicion)
		VALUES ('$nombre','$descripcion',1)";
		return ejecutarConsulta($sql);
	}

	//Edita registros
	public function editar($ideditorial,$nombre,$descripcion)
	{
		$sql="UPDATE editorial SET edi_nombre='$nombre', edi_descripcion='$descripcion' WHERE edi_id='$ideditorial'";
		return ejecutarConsulta($sql);
	}

	//Elimina categorias
	public function desactivar($ideditorial)
	{
		$sql="UPDATE editorial SET edi_condicion=0 WHERE edi_id='$ideditorial'";
		return ejecutarConsulta($sql);
	}

	//Activa categorias
	public function activar($ideditorial)
	{
		$sql="UPDATE editorial SET edi_condicion=1 WHERE edi_id='$ideditorial'";
		return ejecutarConsulta($sql);
	}

	//Mostar los datos de una editorial
	public function mostrar($ideditorial)
	{
		$sql="SELECT * FROM editorial WHERE edi_id='$ideditorial'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Mostrar todos los datos de la tabla editorial
	public function listar()
	{
		$sql="SELECT * FROM editorial";
		return ejecutarConsulta($sql);		
	}
	//Mostrar los registros de condicion = 1
	public function select()
	{
		$sql="SELECT * FROM editorial where edi_condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>
</body>
</html>