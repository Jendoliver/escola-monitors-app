<?php
require_once "bbdd_lib.php";
require_once "error_lib.php";

if(isset($_POST["tipus_curs"])) // VENIMOS DE CREARCURSO.PHP
{
    extract($_POST);
    $codigo = insertarCurso($tipus_curs, $modalitat, $preu, $any); // Insertamos el curso y recibimos su código
    if($codigo) // Comprobamos que realmente lo hemos insertado
        mostrarCodigo($codigo); // Mostramos el código del curso recién creado
    else
        errorCrearCurso();
}

else if(isset($_POST["codi_curs"])) // VENIMOS DE ALTA_ALUMNO.PHP OPCIÓN CODIGO CURSO
{
    extract($_POST);
    if(cursoExists($codi_curs)) // Comprobamos que el curso existe
    {
        if(insertarAlumno($codi_curs, $dni_alumne, $nom, $cognom1, $cognom2, $data_naixement, $direccio, $telefon, $email_alumne)) // Insertamos el alumno y comprobamos que no hay error
            alumnoInsertado();
        else
            errorInsertarAlumno();
    }
    else
        errorCursoNoExiste();
}

else if(isset($_POST["tipus_curs_alumne"])) // VENIMOS DE ALTA_ALUMNO.PHP OPCIÓN TIPO+MODALIDAD+AÑO
{
    extract($_POST);
    $codigo = getCodeByTMA($tipus_curs_alumne, $modalitat_alumne, $any_alumne); // Buscamos el curso con esa mierda y recibimos su código, que es lo que chana
    if($codigo) // Comprobamos que existe el curso, igual que el caso anterior
    {
        if(insertarAlumno($codigo, $dni_alumne, $nom, $cognom1, $cognom2, $data_naixement, $direccio, $telefon, $email_alumne)) // Insertamos el alumno y comprobamos que no hay error
            alumnoInsertado();
        else
            errorInsertarAlumno();
    }
    else
        errorCursoNoExiste();
}

else
{
    errorInsertor();
}

?>