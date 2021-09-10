<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
<?php 
require "../controlador/Conexion.php";

class Libro
{
	public function __construct(){}

	public function insertar($titulo,$cantidad_disponible,$idautor,$ideditorial,$year_edicion,$idmateria,$numero_paginas,$formato,$peso,$descripcion,$imagen)
	{
		$sql="INSERT INTO libro (lib_titulo,lib_cantidaddisponible,aut_id,edi_id,lib_anioedicion,mat_id,lib_cantidadpaginas,lib_formato,lib_peso,lib_descripcion,lib_portada,lib_estado)
		VALUES ('$titulo','$cantidad_disponible','$idautor','$ideditorial','$year_edicion','$idmateria','$numero_paginas','$formato','$peso','$descripcion','$imagen','1')";
		return ejecutarConsulta($sql);
	}
	/*De aqui en adelante no falta de editar*/
	public function editar($idlibro,$titulo,$cantidad_disponible,$idautor,$ideditorial,$year_edicion,$idmateria,$numero_paginas,$formato,$peso,$descripcion,$imagen)
	{
		$sql="UPDATE libro SET lib_titulo='$titulo',lib_cantidaddisponible='$cantidad_disponible',aut_id='$idautor',edi_id='$ideditorial',lib_anioedicion='$year_edicion',mat_id='$idmateria',lib_cantidadpaginas='$numero_paginas',lib_formato='$formato',lib_peso='$peso',lib_descripcion='$descripcion',lib_portada='$imagen' WHERE lib_id='$idlibro'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idlibro)
	{
		$sql="UPDATE libro SET lib_estado='0' WHERE lib_id='$idlibro'";
		return ejecutarConsulta($sql);
	}

	public function activar($idlibro)
	{
		$sql="UPDATE libro SET lib_estado='1' WHERE lib_id='$idlibro'";
		return ejecutarConsulta($sql);
	}
	//muestra un libro dado el id
	public function mostrar($idlibro)
	{
		$sql="SELECT * FROM libro WHERE lib_id='$idlibro'";
		return ejecutarConsultaSimpleFila($sql);
	}
	//lista todos los libros activados
	public function listar()
	{
		$sql="SELECT l.lib_id,l.lib_titulo,l.lib_cantidaddisponible,l.aut_id,a.aut_nombre as autor,l.edi_id,e.edi_nombre as editorial,l.lib_anioedicion,l.mat_id,m.mat_nombre as materia,l.lib_cantidadpaginas,l.lib_formato,l.lib_peso,l.lib_descripcion,l.lib_portada,l.lib_estado FROM libro l INNER JOIN autor a on l.aut_id=a.aut_id INNER JOIN editorial e ON l.edi_id=e.edi_id INNER JOIN materia m ON l.mat_id=m.mat_id";
		return ejecutarConsulta($sql);		
	}

	public function select()
        {
         $sql="SELECT * FROM libro WHERE lib_estado='1'";
         return ejecutarConsulta($sql);
        }

}
?>
</body>
</html>