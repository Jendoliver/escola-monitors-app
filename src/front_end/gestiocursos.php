<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestió de cursos</title>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <header><a href="homepage.php"><img src="img/escolamonitorslogo.png"></img></a></header>
    <h1>GESTIÓ DE CURSOS</h1>
    <div class="main-container">
        <nav>
            <ul>
                <li><a href="crearcurso.php">Crear un curs</a>
                <li><a href="alta_alumno.php">Donar d'alta alumne a curs</a>
                <li><a href="buscarcurso.php">Cercar/gestionar un curs</a>
            </ul>
        </nav>
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>