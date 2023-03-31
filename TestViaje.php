<?php

include('./Viaje.php');
include('entradas_consola.php');

echo "\n\n\n";
$separador = "######################################################\n";

echo $separador;
echo "\tTEST_VIAJE\n";
echo $separador;
echo "\n";
/* Iniciamos los TEST */

$viajes = [];

$process = true;

/** Ejecucion programaq */
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

		case '7':
			echo $separador;
			modificarPasajero($viajes);
			echo $separador;
			break;

		case '8':
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

/** Genera un Mennu para el usuario */ function menu()
{
	global $separador;

	echo "[1] - Crear un viaje\n";
	echo "[2] - Modificar destino de un viaje\n";
	echo "[3] - Modificar maximo de pasajeros de un viaje\n";
	echo "[4] - Agregar pasajero a un viaje\n";
	echo "[5] - Listar pasajeros de un viaje\n";
	echo "[6] - Retirar pasajero de un viaje\n";
	echo "[7] - Modificar pasajero de un viaje\n";
	echo "[8] - Listar viajes\n\n";
	echo "[0] - Salir\n\n";
	echo $separador;
	echo "\n";
}

/**
 * Solicita al usuarios los datos del viaje para crear y retonar un viaje 
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 * 
 * @return Viaje nuevo instancia del objeto Viaje.
 */
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

/**
 * Verificamos dentro de los viajes si ya existe un viaje con el codigo ingresado
 * 
 * @param string $codigo atributo de Viaje que se busca dentro del arreglo * 
 * @param array $viajes Arrelgo de objetos Viaje.
 * 
 * @return bool Valor de verdad.
 */
function existeViaje(string $codigo, array $viajes): bool
{
	$viajes = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	});

	return (bool) count($viajes);
}

/**
 * Buscamos el viaje por codigo y luego solicitamos al usuario cual va ser el nuevo destino
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 */
function modificarDestinoViaje(array $viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = buscarViajePorCodigo($viajes, $codigo);

	$destino = pedirDestino();

	$viaje->setDestino($destino);
}

/**
 * Buscamos el viaje por codigo y luego solicitamos al usuario cual va ser el maximo de pasajeros
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 */
function modificarMaxPasajeros(array $viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = buscarViajePorCodigo($viajes, $codigo);

	$maxPasajeros = pedirMaxPasajeros();

	$viaje->setCantMaxPasajeros($maxPasajeros);
}

/**
 * Buscamos el viaje por codigo y luego solicitamos al los datos del nuevo pasajero
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 */
function agregarPasajero(array $viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = buscarViajePorCodigo($viajes, $codigo);

	/* Verificamos que exista lugar para un nuevo pasajero */
	if ($viaje->getCantMaxPasajeros() > $viaje->getCantPasajeros()) {
		$documento = pedirDocumentoNuevo($viaje);

		$nombre = pedirNombre();

		$apellido = pedirApellido();

		$pasajero = [
			'documento' => $documento,
			'nombre' => $nombre,
			'apellido' => $apellido,
		];

		$viaje->agregarPasajero($pasajero);
	} else {
		echo "El número de pasajeros del viaje llego a su limite\n";
	}
}

/**
 * Lista todos los pasajeros de un viaje
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 */
function listarPasajeros($viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = buscarViajePorCodigo($viajes, $codigo);

	foreach ($viaje->getPasajeros() as $pasajero) {
		$documento = $pasajero['documento'];
		$nombre = $pasajero['nombre'];
		$apellido = $pasajero['apellido'];

		echo "Documento: $documento\t Nombre: $nombre\t Apellido: $apellido\n";
	}
}

/**
 * Retira a un pasajero del viaje
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 */
function retirarPasajeroViaje($viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];

	$documento = pedirDocumentoExiste($viaje);

	$viaje->retirarPasajero($documento);
}

/**
 * muestra por pantalla todos los viajes
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 */
function listarViajes($viajes): void
{
	foreach ($viajes as $viaje) {
		echo $viaje;
	}
}

/**
 * Modifica un pasajero de un viaje
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 */
function modificarPasajero($viajes): void
{
	$codigo = pedirCodigoExiste($viajes);

	$viaje = buscarViajePorCodigo($viajes, $codigo);

	$documento = pedirDocumentoExiste($viaje);

	if ($viaje->existePasajero($documento)) {
		$nombre = pedirNombre();

		$apellido = pedirApellido();

		$pasajero = [
			'documento' => $documento,
			'nombre' => $nombre,
			'apellido' => $apellido,
		];

		/* Admito que estoy haciendo trampa, por cuestiones de tiempo no puedo hacer esta logica */
		$viaje->retirarPasajero($documento);

		$viaje->agregarPasajero($pasajero);
	} else {
		echo "NO existe el pasajeo dentro del viaje: $codigo\n";
	}
}

/**
 * Recibe un arreglo de viajes y busca el viaje  
 * 
 * @param array $viajes Arrelgo de objetos Viaje.
 * @param string codigo Codigo a buscar
 * 
 * @return Viaje Viaje encontrado
 */
function buscarViajePorCodigo(array $viajes, string $codigo)
{
	return array_filter($viajes, function (Viaje $viaje) use ($codigo) {
		return $viaje->getCodigo() == $codigo;
	})[0];
}
