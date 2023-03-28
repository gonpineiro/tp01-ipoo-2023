<?php

include('./Viaje.php');
echo "\n\n\n";
$separador = "###########################\n";

echo $separador;
echo "\tTEST_VIAJE\n";
echo $separador;
echo "\n";
/* Iniciamos los TEST */

$viajes = [];

$process = true;
while ($process) {
	menu();

	$opcion = readLine("Ingrese una opción: ");

	switch ($opcion) {
		case '1':
			$viajes[] = crearViaje($viajes);
			break;

		case '2':
			echo $separador;
			modificarDestinoViaje($viajes);
			echo $separador;
			break;

		case '3':
			echo $separador;
			listarViajes($viajes);
			echo $separador;
			break;

		case '0':
			$process = false;
			break;

		default:
			echo "Opcion incorrecta\n\n";
			break;
	}
}

function menu()
{
	global $separador;

	echo "[1] - Crear un viaje\n";
	echo "[2] - Modificar destino de un viaje\n";
	echo "[3] - Listar viajes\n";
	echo "[0] - Salir\n\n";
	echo $separador;
	echo "\n";
}

/* Solicita al usuarios los datos del viaje para crear y retonar un viaje */
function crearViaje(array $viajes): Viaje
{
	/* Validamos el ingreso del codigo */
	$codigo = '';
	while ($codigo == '' || existeViaje($codigo, $viajes)) {
		$codigo = readLine("Código: ");
		if ($codigo == '') {
			echo "Código invalido\n";
		} elseif (existeViaje($codigo, $viajes)) {
			echo "Ya existe un viaje con el código: $codigo\n";
		}
	}

	/* Validamos el ingreso del destino */
	$destino = '';
	while ($destino == '') {
		$destino = readLine("Destino: ");
		if ($destino == '') {
			echo "Destino invalido\n";
		}
	}

	/* Validamos el ingreso de maxPasajeros */
	$maxPasajeros = '';
	while ($maxPasajeros == '') {
		$maxPasajeros = readLine("Maximo de pasajeros: ");
		if ($maxPasajeros == '') {
			echo "Valor invalido\n";
		}
	}

	/* Creamos el viaje */
	$viaje = new Viaje($codigo, $destino, $maxPasajeros);

	return $viaje;
}

function existeViaje(string $codigo, array $viajes): bool
{
	$existeCodigo = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	});

	return (bool) count($existeCodigo);
}

function modificarDestinoViaje(array $viajes): void
{
	$codigo = '';
	while ($codigo == '' || !existeViaje($codigo, $viajes)) {
		$codigo = readLine("Código: ");
		if ($codigo == '') {
			echo "Código invalido\n";
		} elseif (!existeViaje($codigo, $viajes)) {
			echo "No existe un viaje con el código: $codigo\n";
		}
	}

	$viaje = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];

	$destino = '';
	while ($destino == '') {
		$destino = readLine("Destino: ");
		if ($destino == '') {
			echo "Destino invalido\n";
		}
	}

	$viaje->setDestino($destino);
}

function listarViajes($viajes): void
{
	foreach ($viajes as $viaje) {
		echo $viaje;
	}
}
