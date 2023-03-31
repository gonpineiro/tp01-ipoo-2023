<?php
class Viaje
{
	private  $codigo;
	private  $destino;
	private  $cantMaxPasajeros;
	private $pasajeros;

	public function  __construct(string $codigo, string $destino, int $cantMaxPasajeros, array $pasajeros = [])
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

	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}

	public function getDestino(): string
	{
		return $this->destino;
	}

	public function setDestino($destino)
	{
		$this->destino = $destino;
	}

	public function getCantMaxPasajeros(): int
	{
		return $this->cantMaxPasajeros;
	}

	public function setCantMaxPasajeros($cantMaxPasajeros)
	{
		$this->cantMaxPasajeros = $cantMaxPasajeros;
	}

	public function getCantPasajeros()
	{
		return count($this->pasajeros);
	}

	public function getPasajeros(): array
	{
		return $this->pasajeros;
	}

	public function setPasajeros($pasajeros)
	{
		$this->pasajeros = $pasajeros;
	}

	public function agregarPasajero(array $pasajero)
	{
		$bool = true;
		if ($this->getCantPasajeros() < $this->getCantMaxPasajeros()) {
			$this->pasajeros[] = $pasajero;
		} else {
			$bool = false;
		}
		return $bool;
	}

	public function retirarPasajero($documento)
	{
		$pasajerosNuevos = array_filter($this->getPasajeros(), function ($pasajero) use ($documento) {
			return $pasajero['documento'] !=  $documento;
		});

		$this->pasajeros = $pasajerosNuevos;
	}

	public function existePasajero($documento): bool
	{
		$pasajero = array_filter($this->getPasajeros(), function (array $pasajero) use ($documento) {
			return $pasajero['documento'] == $documento;
		});

		return (bool) count($pasajero);
	}

	public function __toString()
	{
		$codigo = $this->getCodigo();
		$destino = $this->getDestino();
		$cantMaxPasajeros = $this->getCantMaxPasajeros();
		$cantPasajeros = $this->getCantPasajeros();
		return "Código: $codigo\t Destino: $destino\t Max Pasajeros: $cantMaxPasajeros\t Cantidad Pasajeros: $cantPasajeros\n";
	}
}
