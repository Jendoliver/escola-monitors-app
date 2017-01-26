<?php

require_once "bbdd_lib.php";

if(isset($_POST["curs"]))
{
    updateCurso($tipus_curs, $modalitat, $fecha_ini, $fecha_fin, $lugar, $preu);
}
else if(isset($_POST["personal"]))
{
    updateAlumnoPersonal($nom, $cognom1, $cognom2, $data_naixement, $direccio, $telefon, $email_alumne);
}
else if(isset($_POST["expedient"]))
{
    updateAlumnoExpedient($teorica, $practica, $convocatoria, $memoria, $aprovat);
}
else if(isset($_POST["deutes"]))
{
    updateAlumnoDeutas($money);
}
else
    errorUpdater();