<?php

require_once "bbdd_lib.php";

if(isset($_POST["codi_curs"])) // VENIMOS DE buscarcurso.php CON CÓDIGO DE CURSO
{
    $code = $_POST["codi_curs"];
    if(cursoExists($code)) // comprobamos que el curso existe
    {
        showCursoByCode($code);
    }
    else
        errorCursoNoExiste();
}

else if(isset($_POST["tipus_curs"])) // VENIMOS DE buscarcurso.php CON OPCIONES MÚLTIPLES
{
    extract($_POST);
    showCursos($tipus_curs, $modalitat_curs, $any_curs);
}

else if(isset($_POST["data"])) // VENIMOS DE gestioalumnes.php pa buscar un alumno en kokreta
{
    extract($_POST); // Toca checkiar el tipo de dato
    switch($tipo)
    {
        case "nom": showAlumnoByNom($data); break; // hay que actualizar esto a nombre, ape1, ape2
        case "email": showAlumnoByEmail($data); break;
        case "dni": showAlumnoByDNI($data); break;
        case "tel": showAlumnoByTel($data); break;
        default: errorSelector();
    }
    printBackButton();
}

else if(isset($_POST["submit"])) // VENIMOS DE gestioalumnes.php, pudiendo ser lista morosos, aprobados...
{
    if($_POST["submit"] == "morosos") // mostrar listado morosos
    {
        showMorosos();
    }
    else if($_POST["submit"] == "aprobados") // mostrar listado aprobados
    {
        showAprobados();
    }
    //else if ... se puede extender easy
}

else
    errorSelector();