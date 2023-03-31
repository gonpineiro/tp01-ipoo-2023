<?php

/** Solicita al usuario el ingreso de un codigo
 * esta funcion trambien realiza validaciones */
function pedirCodigoNuevo($viajes): string
{
    $codigo = '';
    while ($codigo == '' || existeViaje($codigo, $viajes)) {
        $codigo = readLine("Código del viaje: ");
        if ($codigo == '') {
            echo "Código invalido\n";
        } elseif (existeViaje($codigo, $viajes)) {
            echo "Ya existe un viaje con el código: $codigo\n";
        }
    }

    return $codigo;
}

/** Solicita al usuario el ingreso de un codigo
 * esta funcion trambien realiza validaciones */
function pedirCodigoExiste($viajes): string
{
    $codigo = '';
    while ($codigo == '' || !existeViaje($codigo, $viajes)) {
        $codigo = readLine("Código del viaje: ");
        if ($codigo == '') {
            echo "Código invalido\n";
        } elseif (!existeViaje($codigo, $viajes)) {
            echo "No existe un viaje con el código: $codigo\n";
        }
    }

    return $codigo;
}

/** Solicita al usuario el ingreso de un destino
 * esta funcion trambien realiza validaciones */
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


/** Solicita al usuario el ingreso de un max de pasajeros
 * esta funcion trambien realiza validaciones */
function pedirMaxPasajeros(): string
{
    $maxPasajeros = '';
    while ($maxPasajeros == '' || !is_int($maxPasajeros)) {
        $maxPasajeros = (int) readLine("Maximo de pasajeros: ");
        if ($maxPasajeros == '') {
            echo "Valor invalido\n";
        }
    }

    return $maxPasajeros;
}

/** Solicita al usuario el ingreso de un documento del pasajero
 * esta funcion trambien realiza validaciones */
function pedirDocumentoNuevo($viaje): string
{
    $documento = '';
    while ($documento == '' || $viaje->existePasajero($documento)) {
        $documento = readLine("Documento: ");
        if ($documento == '') {
            echo "Documento invalido\n";
        } elseif ($viaje->existePasajero($documento)) {
            echo "Ya existe un pasajero con el documento: $documento\n";
        }
    }

    return $documento;
}

/** Solicita al usuario el ingreso de un nombre del pasajero
 * esta funcion trambien realiza validaciones */
function pedirNombre(): string
{
    $nombre = '';
    while ($nombre == '') {
        $nombre = readLine("Nombre del pasajero: ");
        if ($nombre == '') {
            echo "Nombre invalido\n";
        }
    }

    return $nombre;
}

/** Solicita al usuario el ingreso de un apellido del pasajero
 * esta funcion trambien realiza validaciones */
function pedirApellido(): string
{
    $apellido = '';
    while ($apellido == '') {
        $apellido = readLine("Apellido del pasajero: ");
        if ($apellido == '') {
            echo "Apellido invalido\n";
        }
    }

    return $apellido;
}

/** Solicita al usuario el ingreso de un apellido del pasajero
 * esta funcion trambien realiza validaciones */
function pedirDocumentoExiste($viaje): string
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
