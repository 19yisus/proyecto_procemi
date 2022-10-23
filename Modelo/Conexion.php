<?php
class bd
{
	private $conexion;
	function conecta()
	{
		$this->conexion = mysqli_connect("localhost", "root", "", "proyecto_procemi");
		if (mysqli_connect_error()) die("No se conecta: " . mysqli_connect_error());
	}
	
	public function ejecutar($sql)
	{
		$this->conecta();
		return mysqli_query($this->conexion, $sql); //se ejecuta
	}

	protected function ultimoID()
	{
		return mysqli_insert_id($this->conexion);
	}

	protected function beginTransaccion()
	{
		$this->conecta();
		return mysqli_autocommit($this->conexion, false);
	}

	protected function queryTransaccion($sql)
	{
		return mysqli_query($this->conexion, $sql);
	}

	protected function rollback()
	{
		return mysqli_rollback($this->conexion);
	}

	protected function commit()
	{
		mysqli_commit($this->conexion);
		return mysqli_close($this->conexion);
	}
}
