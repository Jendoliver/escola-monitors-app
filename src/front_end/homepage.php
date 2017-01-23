<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet" type="text/css"/>
    <title>Gestió de l'Escola</title>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <header><img src=""></img></header>
    <h1>GESTIÓ DE L'ESCOLA DE MONITORS</h1>
    <div class="main-container">
        <nav>
            <ul>
                <li><a href="gestioalumnes.php">Gestionar alumnes</a>
                <li><a href="gestiocursos.php">Gestionar cursos</a>
            </ul>
        </nav>
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>