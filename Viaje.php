<?php
class Viaje
{
	private  $codigo;
	private  $destino;
	private  $cantMaxPasajeros;
	private  $cantPasajeros;
	private $pasajeros;

	public function  __construct($codigo, $destino, $cantMaxPasajeros, $cantPasajeros, $pasajeros = [])
	{
		$this->codigo = $codigo;
		$this->destino = $destino;
		$this->cantMaxPasajeros = $cantMaxPasajeros;
		$this->cantPasajeros = $cantPasajeros;
		$this->pasajeros = $pasajeros;
	}

	public function getCodigo()
	{
		return $this->codigo;
	}

	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;
		return $this;
	}

	public function getDestino()
	{
		return $this->destino;
	}

	public function setDestino($destino)
	{
		$this->destino = $destino;
		return $this;
	}

	public function getCantMaxPasajeros()
	{
		return $this->cantMaxPasajeros;
	}

	public function setCantMaxPasajeros($cantMaxPasajeros)
	{
		$this->cantMaxPasajeros = $cantMaxPasajeros;
		return $this;
	}

	public function getCantPasajeros()
	{
		return $this->cantPasajeros;
	}

	public function setCantPasajeros($cantPasajeros)
	{
		$this->cantPasajeros = $cantPasajeros;
		return $this;
	}

	public function getPasajeros()
	{
		return $this->pasajeros;
	}

	public function setPasajeros($pasajeros)
	{
		$this->pasajeros = $pasajeros;
		return $this;
	}

	public function agregarPasajero($pasajero)
	{
		$pasajeroData = $this->validarPasajero($pasajero);
		if (!$pasajeroData) {
			return false;
		}

		$this->pasajeros[] = $pasajeroData;
	}

	/**
	 * Retorna un arreglo asociativo con 3 claves (nombre, apellido, documento)
	 * si no encuentra ninguno de los 3 o encuentra algun dato erroeno retorna falso
	 * 
	 * @param $pasajero Datos del pasajero
	 * 
	 * @return array|false
	 */
	private function validarPasajero($pasajero)
	{
		if (isset($pasajero['nombre']) && $pasajero['nombre'] != '') {
			if (isset($pasajero['apellido']) && $pasajero['apellido'] != '') {
				if (isset($pasajero['documento']) && $pasajero['documento'] != '') {
					return [
						'nombre' => $pasajero['nombre'],
						'apellido' => $pasajero['apellido'],
						'documento' => $pasajero['documento'],
					];
				}
			}
		}

		return false;
	}
}
