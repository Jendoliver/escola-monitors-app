<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet" type="text/css"/>
    <title>Gestió d'alumnes</title>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <header><img src=""></img></header>
    <h1>GESTIÓ D'ALUMNES</h1>
    <div class="main-container">
        Buscar alumne:
        <form action="gestioalumnes.php" method="POST">
            Cerca per nom, mail, DNI o telèfon: <input type="text" name="data" placeholder="Introdueix aqui les dades...">
            <input type="submit">
        </form>
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>