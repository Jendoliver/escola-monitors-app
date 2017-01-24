<?php
/*
*
* error_lib.php: LIBRERÍA DE ERRORES DE LA APLICACIÓN
*
*/
require_once "print_lib.php";

function noResults()
{
    echo "No se han encontrado resultados";
}

function errorCrearCurso()
{
    echo "ERROR CREANDO EL CURSO";
}

function errorInsertarAlumno()
{
    echo "ERROR INSERTANDO ALUMNO";
}

function errorCursoNoExiste()
{
    echo "EL CURSO NO EXISTE";
}

function errorInsertor()
{
    echo "ERROR EN INSERTOR.PHP";
}

function errorConsulta()
{
    echo "ERROR AL CONSULTAR A LA BASE DE DATOS";
}

function errorLogin()
{
    echo "LOGIN INCORRECTO";
}

function errorNotLogged()
{
    echo "No has iniciat sessio --- ACCES DENEGAT";
    echo "<input type='submit' value='Iniciar Sessió' formaction='index.php'>"
}

function errorSelector()
{
    echo "ERROR EN SELECTOR.PHP";
}