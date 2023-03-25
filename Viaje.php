<?php
class Viaje
{
	private  $codigo;
	private  $destino;
	private  $cant_max_pasajeros;
	private  $cant_pasajeros;

	public function  __construct($codigo, $destino, $cant_max_pasajeros, $cant_pasajeros)
	{
		$this->codigo = $codigo;
		$this->destino = $destino;
		$this->cant_max_pasajeros = $cant_max_pasajeros;
		$this->cant_pasajeros = $cant_pasajeros;
	}
}
