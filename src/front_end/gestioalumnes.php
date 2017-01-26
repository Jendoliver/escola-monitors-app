<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet" type="text/css"/>
    <title>Gestió d'alumnes</title>
    <script type="text/javascript" src="formgestioalumnes.js"></script>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <header><a href="homepage.php"><img src="img/escolamonitorslogo.png"></img></a></header>
    <h1>GESTIÓ D'ALUMNES</h1>
    <div class="main-container">
        Buscar alumne:
        <form action="../back_end/selector.php" method="POST">
            Tipus de cerca: <input type="radio" name="tipo" value="nom" onclick="nom()" required> Per Nom <input type="radio" name="tipo" value="email" onclick="email()" selected required> Per Email <input type="radio" name="tipo" value="dni" onclick="dni()" required> Per DNI <input type="radio" name="tipo" value="tel" onclick="tel()" required> Per Telèfon
            <div id="datainput"><input type="text" name="data" placeholder="Introdueix aqui les dades..." required></div>
            <input type="submit" value="CERCA">
        </form><br><br>
        
        Cercar alumnes que no han pagat: <form action="../back_end/selector.php" method="POST"><input type="submit" name="morosos" value="CERCA"></form>
        Cercar alumnes aprovats: <form action="../back_end/selector.php" method="POST"><input type="submit" name="aprobados" value="CERCA"></form>
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>