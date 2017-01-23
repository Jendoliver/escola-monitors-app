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