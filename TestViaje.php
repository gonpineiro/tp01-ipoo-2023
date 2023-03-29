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
			modificarMaxPasajeros($viajes);
			echo $separador;
			break;

		case '4':
			echo $separador;
			agregarPasajero($viajes);
			echo $separador;
			break;

		case '5':
			echo $separador;
			listarPasajeros($viajes);
			echo $separador;
			break;

		case '6':
			echo $separador;
			retirarPasajeroViaje($viajes);
			echo $separador;
			break;

		case '6':
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
	echo "[3] - Modificar maximo de pasajeros de un viaje\n";
	echo "[4] - Agregar pasajero a un viaje\n";
	echo "[5] - Listar pasajeros de un viaje\n";
	echo "[6] - Retirar pasajero de un viaje\n";
	echo "[7] - Listar viajes\n";
	echo "[0] - Salir\n\n";
	echo $separador;
	echo "\n";
}

/* Solicita al usuarios los datos del viaje para crear y retonar un viaje */
function crearViaje(array $viajes): Viaje
{
	/* Validamos el ingreso del codigo */
	$codigo = pedirCodigoNuevo($viajes);

	/* Validamos el ingreso del destino */
	$destino = pedirDestino();

	/* Validamos el ingreso de maxPasajeros */
	$maxPasajeros = pedirMaxPasajeros();

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
	$codigo = pedirCodigoExiste($viajes);

	$viaje = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];

	$destino = pedirDestino();

	$viaje->setDestino($destino);
}

function modificarMaxPasajeros(array $viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];

	$maxPasajeros = pedirMaxPasajeros();

	$viaje->setCantMaxPasajeros($maxPasajeros);
}

function agregarPasajero(array $viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];

	$documento = '';
	while ($documento == '' || $viaje->existePasajero($documento)) {
		$documento = readLine("Documento: ");
		if ($documento == '') {
			echo "Documento invalido\n";
		} elseif ($viaje->existePasajero($documento)) {
			echo "Ya existe un pasajero con el documento: $documento\n";
		}
	}

	$nombre = '';
	while ($nombre == '') {
		$nombre = readLine("Nombre del pasajero: ");
		if ($nombre == '') {
			echo "Nombre invalido\n";
		}
	}

	$apellido = '';
	while ($apellido == '') {
		$apellido = readLine("Apellido del pasajero: ");
		if ($apellido == '') {
			echo "Apellido invalido\n";
		}
	}

	$pasajero = [
		'documento' => $documento,
		'nombre' => $nombre,
		'apellido' => $apellido,
	];

	$viaje->agregarPasajero($pasajero);
}

function listarPasajeros($viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];

	foreach ($viaje->getPasajeros() as $pasajero) {
		$documento = $pasajero['documento'];
		$nombre = $pasajero['nombre'];
		$apellido = $pasajero['apellido'];
		echo "Documento: $documento\t Nombre: $nombre\t Apellido: $apellido\n";
	}
}

function retirarPasajeroViaje($viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];

	$documento = pedirDocumento($viaje);

	$viaje->retirarPasajero($documento);
}

function listarViajes($viajes): void
{
	foreach ($viajes as $viaje) {
		echo $viaje;
	}
}

function pedirCodigoNuevo($viajes): string
{
	$codigo = '';
	while ($codigo == '' || existeViaje($codigo, $viajes)) {
		$codigo = readLine("Código: ");
		if ($codigo == '') {
			echo "Código invalido\n";
		} elseif (existeViaje($codigo, $viajes)) {
			echo "Ya existe un viaje con el código: $codigo\n";
		}
	}

	return $codigo;
}

function pedirCodigoExiste($viajes): string
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

	return $codigo;
}

function pedirDestino(): string
{
	$destino = '';
	while ($destino == '') {
		$destino = readLine("Destino: ");
		if ($destino == '') {
			echo "Destino invalido\n";
		}
	}

	return $destino;
}

function pedirMaxPasajeros(): string
{
	$maxPasajeros = '';
	while ($maxPasajeros == '') {
		$maxPasajeros = readLine("Maximo de pasajeros: ");
		if ($maxPasajeros == '') {
			echo "Valor invalido\n";
		}
	}

	return $maxPasajeros;
}

function pedirDocumento($viaje): string
{
	$documento = '';
	while ($documento == '' || !$viaje->existePasajero($documento)) {
		$documento = readLine("Documento: ");
		if ($documento == '') {
			echo "Documento invalido\n";
		} elseif (!$viaje->existePasajero($documento)) {
			echo "No existe un pasajero con el documento: $documento\n";
		}
	}

	return $documento;
}
