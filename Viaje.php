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
}
