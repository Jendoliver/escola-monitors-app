<?php

require_once "bbdd_lib.php";
if(!auth())
        errorNotLogged();
else
{
    if(isset($_POST["curs"]))
    {
        extract($_POST);
        updateCurso($code, $tipus_curs, $modalitat, $fecha_ini, $fecha_fin, $lugar, $preu);
    }
    else if(isset($_POST["personal"]))
    {
        extract($_POST);
        updateAlumnoPersonal($dni, $nom, $cognom1, $cognom2, $data_naixement, $direccio, $telefon, $email_alumne);
    }
    else if(isset($_POST["expedient"]))
    {
        extract($_POST);
        updateAlumnoExpedient($dni, $teorica, $practica, $convocatoria, $memoria, $aprovat, $numtitol);
    }
    else if(isset($_POST["deutes"]))
    {
        extract($_POST);
        updateAlumnoDeutas($dni, $money);
    }
    else
        errorUpdater();
}