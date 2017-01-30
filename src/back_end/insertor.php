<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insertor</title>
</head>
<body>
    <?php
    require_once "bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    {
        if(isset($_POST["tipus_curs"])) // VENIMOS DE CREARCURSO.PHP
        {
            extract($_POST);
            $codigo = insertarCurso($tipus_curs, $modalitat, $fecha_ini, $fecha_fin, $lugar, $preu); // Insertamos el curso y recibimos su código
            if($codigo) // Comprobamos que realmente lo hemos insertado
                mostrarCodigo($codigo); // Mostramos el código del curso recién creado
            else
                errorCrearCurso();
        }
        
        else if(isset($_POST["codi_curs"])) // VENIMOS DE ALTA_ALUMNO.PHP
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
        
        else
        {
            errorInsertor();
        }
    }
    ?>
</body>
</html>