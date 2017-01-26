<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creació de curs</title>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <header><a href="homepage.php"><img src="img/escolamonitorslogo.png"></img></a></header>
    <h1>Creació d'un nou curs</h1>
    <div class="main-container">
        Introdueix les dades del nou curs (els camps amb * són obligatoris):
        <form action="../back_end/insertor.php" method="POST">
            Tipus del curs*: <input type=radio name="tipus_curs" value="0" required> Monitor <input type=radio name="tipus_curs" value="1" required> Director<br>
            Modalitat*: <input type=radio name="modalitat" value="mati" required> Matí <input type=radio name="modalitat" value="tarda" required> Tarda <input type=radio name="modalitat" value="finde" required> Cap de setmana <input type=radio name="modalitat" value="intensiu" required> Intensiu<br>
            Data d'inici del curs*: <input type="date" name="fecha_ini" required><br>
            Data de finalització del curs*: <input type="date" name="fecha_fin" required><br>
            Lloc on es realitza el curs: <input type="text" name="lugar"><br>
            Preu del curs*: <input type=number min="0" max="10000" name="preu" required> €<br>
            <input type="submit" value="CREAR CURS">
        </form>
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>