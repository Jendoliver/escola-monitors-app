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
    <header><img src=""></img></header>
    <h1>Creació d'un nou curs</h1>
    <div class="main-container">
        Introdueix les dades del nou curs...
        <form action="../back_end/insertor.php" method="POST">
            Tipus del curs: <input type=radio name="tipus_curs" value="M"> Monitor <input type=radio name="tipus_curs" value="D"> Director<br>
            Modalitat: <input type=radio name="modalitat" value="mati"> Matí <input type=radio name="modalitat" value="tarda"> Tarda <input type=radio name="modalitat" value="finde"> Cap de setmana <input type=radio name="modalitat" value="intensiu"> Intensiu<br>
            Preu del curs: <input type=number min="0" max="10000" name="preu" required><br>
            Any del curs: <input type=number min="2017" max="3000" name="any" required><br>
            <input type="submit" value="CREAR CURS">
        </form>
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>