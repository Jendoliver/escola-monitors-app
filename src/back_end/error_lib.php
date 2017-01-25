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
    $message = "Login incorecto";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '../front_end/index.php';
    </script>";
}

function errorNotLogged()
{
    $message = "No has iniciat sessió --- ACCÉS DENEGAT";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '../front_end/index.php';
    </script>";
}

function errorSelector()
{
    echo "ERROR EN SELECTOR.PHP";
}

function errorModificar()
{
    echo "ERROR EN LA LLAMADA A MODIFICARDATOS.PHP";
}