<?php
class Viaje
{
	private  $codigo;
	private  $destino;
	private  $cantMaxPasajeros;
	private $pasajeros;

	public function  __construct($codigo, $destino, $cantMaxPasajeros, $pasajeros = [])
	{
		$this->codigo = $codigo;
		$this->destino = $destino;
		$this->cantMaxPasajeros = $cantMaxPasajeros;
		$this->pasajeros = $pasajeros;
	}

	public function getCodigo(): string
	{
		return $this->codigo;
	}

	public function setCodigo($codigo): Viaje
	{
		$this->codigo = $codigo;
		return $this;
	}

	public function getDestino(): string
	{
		return $this->destino;
	}

	public function setDestino($destino): Viaje
	{
		$this->destino = $destino;
		return $this;
	}

	public function getCantMaxPasajeros(): int
	{
		return $this->cantMaxPasajeros;
	}

	public function setCantMaxPasajeros($cantMaxPasajeros): Viaje
	{
		$this->cantMaxPasajeros = $cantMaxPasajeros;
		return $this;
	}

	public function getCantPasajeros()
	{
		return count($this->pasajeros);
	}

	public function getPasajeros(): array
	{
		return $this->pasajeros;
	}

	public function setPasajeros($pasajeros): Viaje
	{
		$this->pasajeros = $pasajeros;
		return $this;
	}

	public function agregarPasajero(array $pasajero): bool
	{
		$pasajeroData = $this->validarPasajero($pasajero);
		if (!$pasajeroData) {
			return false;
		}

		$this->pasajeros[] = $pasajeroData;
		return true;
	}

	/**
	 * Retorna un arreglo asociativo con 3 claves (nombre, apellido, documento)
	 * si no encuentra ninguno de los 3 o encuentra algun dato erroeno retorna falso
	 * 
	 * @param $pasajero Datos del pasajero
	 * 
	 * @return array|false
	 */
	private function validarPasajero(array $pasajero)
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
