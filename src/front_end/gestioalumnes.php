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
    <header><img src="img/escolamonitorslogo.png"></img></header>
    <h1>GESTIÓ D'ALUMNES</h1>
    <div class="main-container">
        Buscar alumne:
        <form action="selector.php" method="POST"> <!-- MOLARIA Q SI SELECCIONA BUSCAR POR NOMBRE SALGAN 3 INPUTS TEXT PARA NOMBRE, APELLIDO 1 Y APELLIDO 2 (consulta mucho más fácil)-->
            Tipus de cerca: <input type="radio" name="tipo" value="nom" required> Per Nom <input type="radio" name="tipo" value="email" required> Per Email <input type="radio" name="tipo" value="dni" required> Per DNI <input type="radio" name="tipo" value="tel" required> Per Telèfon
            <input type="text" name="data" placeholder="Introdueix aqui les dades..." required>
            <input type="submit" value="CERCA">
        </form><br><br>
        
        Cercar alumnes que no han pagat: <input type="submit" name="morosos" value="CERCA" formaction="selector.php"><br>
        Cercar alumnes aprovats: <input type="submit" name="aprobados" value="CERCA" formaction="selector.php">
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>