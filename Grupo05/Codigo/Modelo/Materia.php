<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>

<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../controlador/Conexion.php";

class Materia
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO materia (nombre,descripcion,condicion)
		VALUES ('$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idmateria,$nombre,$descripcion)
	{
		$sql="UPDATE materia SET nombre='$nombre',descripcion='$descripcion' WHERE idmateria='$idmateria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idmateria)
	{
		$sql="UPDATE materia SET condicion='0' WHERE idmateria='$idmateria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idmateria)
	{
		$sql="UPDATE materia SET condicion='1' WHERE idmateria='$idmateria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmateria)
	{
		$sql="SELECT * FROM materia WHERE idmateria='$idmateria'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM materia";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function Select()
	{
		$sql="SELECT * FROM materia where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>

</body>
</html>