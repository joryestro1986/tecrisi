<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Montosiniestro {

	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcliente,$monto,$obervamonto)
	{
		$sql="INSERT INTO cxcobrar (idsiniestro,monto,debe,usuarioalta,usuariomod,obervamonto)
		VALUES ('$idcliente','$monto','$monto',1,1,'$obervamonto')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcliente,$monto,$obervamonto)
	{
		$sql="UPDATE cxcobrar SET debe='$monto', obervamonto='$obervamonto' WHERE idsiniestro='$idcliente'";
		return ejecutarConsulta($sql);
	}

 

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcliente)
	{
		$sql="SELECT * FROM cxcobrar WHERE idsiniestro='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	
    public function listarConSiniestro()
{
    $sql = "SELECT tra.idmovint, CONCAT( 'Siniestro:  ', RTRIM(ltrim(tra.siniestro)),'..     Aseguradora:  ',RTRIM(ltrim(aseg.nombreseg))) siniestro
            FROM tragico tra 
            INNER JOIN aseguradora aseg ON tra.idseguradora = aseg.idseguradora 
			order by tra.siniestro desc";
    return ejecutarConsulta($sql);
}



    public function listar() {
        $sql = "SELECT cxc.idsiniestro,trag.siniestro,cxc.monto,cxc.debe 
                FROM cxcobrar cxc 
                INNER JOIN tragico trag ON cxc.idsiniestro = trag.idmovint ";
        return ejecutarConsulta($sql);
    }
	
}

?>