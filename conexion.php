<?php
class ApptivaDB{
	private $host = "localhost";
	private $usuario = "root";
	private $clave = "";
	private $bd = "vue";
	public $conexion;

	public function __construct(){
		$this->conexion = new mysqli($this->host,$this->usuario,$this->clave,$this->bd) or die(mysqli_error());
		$this->conexion->set_charset("utf8");
	}
	//Insertar
	public function insertar($tabla,$datos){
		$resultado = $this->conexion->query("INSERT INTO $tabla VALUES(null, $datos)") or die(mysqli_error());
		if($resultado)
			return true;
		return false;
	}
	//Borrar
	public function borrar($tabla,$condicion){
		$resultado = $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die(mysqli_error());
		if($resultado)
			return true;
		return false;
	}
	//Actualizar
	public function actualizar($tabla,$campos,$condicion){
		$resultado = $this->conexion->query("UPDATE $tabla SET $campos WHERE $condicion") or die(mysqli_error());
		if($resultado)
			return true;
		return false;
	}
	//Buscar
	public function buscar($tabla,$condicion){
		$resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die(mysqli_error());
		if($resultado)
			return $resultado->fetch_all(MYSQLI_ASSOC);
		return false;
	}
}
?>