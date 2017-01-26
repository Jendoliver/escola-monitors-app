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

else if(isset($_POST["data"]) || isset($_POST["nom"])) // VENIMOS DE gestioalumnes.php pa buscar un alumno en kokreta
{
    extract($_POST); //heckiar el tipo de dato
    switch($tipo)
    {
        case "nom": showAlumnoByNom($nom, $cog1, $cog2); break;
        case "email": showAlumnoByEmail($data); break;
        case "dni": showAlumnoByDNI($data); break;
        case "tel": showAlumnoByTel($data); break;
        default: errorSelector();
    }
}

else if(isset($_POST["morosos"])) // VENIMOS DE gestioalumnes.php, listar morosos.
{
    showMorosos();
}

else if(isset($_POST["aprobados"])) // mostrar listado aprobados
{
    showAprobados();
}
//else if ... se puede extender easy
else
    errorSelector();