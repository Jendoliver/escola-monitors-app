<?php
/*
*
* error_lib.php: LIBRERÍA DE ERRORES DE LA APLICACIÓN
*
*/
require_once "print_lib.php";

/**********ERRORES COMUNES DE USUARIO************/
function errorInsertarAlumno()
{
    $message = "Error insertant alumne: ja està inscrit al curs";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '../front_end/alta_alumno.php';
    </script>";
}

function errorCursoNoExiste()
{
    $message = "El curs especificat no existeix";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '../front_end/alta_alumno.php';
    </script>";
}

function errorNoResults()
{
    echo "<h1>No hi ha resultats</h1>";
}

function errorLogin()
{
    $message = "Login incorecte";
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

/******ERRORES GRAVES*******/
function errorSelector()
{
    echo "<h1>ERROR AL FITXER SELECTOR.PHP: CONTACTA AMB EL TEU PROGRAMADOR</h1>";
}

function errorUpdater()
{
    echo "<h1>ERROR AL FITXER UPDATER.PHP: CONTACTA AMB EL TEU PROGRAMADOR</h1>";
}

function errorModificar()
{
    echo "<h1>ERROR EN LA CRIDA A MODIFICARDATOS.PHP: CONTACTA AMB EL TEU PROGRAMADOR</h1>";
}

function errorInsertor()
{
    echo "<h1>ERROR AL FITXER INSERTOR.PHP: CONTACTA AMB EL TEU PROGRAMADOR</h1>";
}

function errorConsulta()
{
    echo "<h1>ERROR AL CONSULTAR A LA BASE DE DADES: CONTACTA AMB EL TEU PROGRAMADOR</h1>";
}

function errorCrearCurso()
{
    echo "<h1>ERROR CREANT EL CURS: CONTACTA AMB EL TEU PROGRAMADOR</h1>";
}

function errorCreateTable()
{
    echo "<h1>ERROR EN LA FUNCIÓ CREATE TABLE: CONTACTA AMB EL TEU PROGRAMADOR</h1>";
}
