<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selector</title>
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="../css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row"> <!-- Imagen -->
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <header><a href="../front_end/homepage.php"><img src="../front_end/img/escolamonitorslogo.png" class="img-responsive center"></img></a></header>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"> <!-- Tabla según de donde se venga -->
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="container">
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
                        showCursos($tipus_curs, $modalitat_curs, $data_curs);
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
                    else if(isset($_POST["back"])) // solucion cutre del bug boton patras
                    {
                        header('Location: ../front_end/homepage.php');
                    }
                    else
                        errorSelector();
                    ?>  
                </div>
            </div>
            <div class="col-md-1"></div>
        </div> <!-- end row -->
    </div>    
</body>
</html>