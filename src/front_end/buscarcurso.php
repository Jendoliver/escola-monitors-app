<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cerca i gestió de cursos</title>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <header><a href="homepage.php"><img src="img/escolamonitorslogo.png"></img></a></header>
    <h1>Cerca de cursos</h1>
    <div class="main-container">
        Cercar un únic curs mitjançant el seu codi:
        <form action="../back_end/selector.php" method="POST">
            Codi de curs: <input type="number" min="1" name="codi_curs"><br>
            <input type="submit" value="CERCA">
        </form><br><br>
        
        Cercar diversos cursos mitjançant tipus, modalitat i data d'inici del curs:
        <form action="../back_end/selector.php" method="POST">
            Tipus de curs: <input type=radio name="tipus_curs" value="M" required> Monitor <input type=radio name="tipus_curs" value="D" required> Director <input type=radio name="tipus_curs" value="ANY" checked required> Qualsevol<br>
            Modalitat: <input type=radio name="modalitat_curs" value="mati" required> Matí <input type=radio name="modalitat_curs" value="tarda" required> Tarda <input type=radio name="modalitat_curs" value="finde" required> Cap de setmana <input type=radio name="modalitat_curs" value="intensiu" required> Intensiu <input type=radio name="modalitat_curs" value="ANY" checked required> Qualsevol<br>
            Data d'inici del curs: <input type="date" name="data_curs"> <input type="radio" name="data_curs" value="ANY"> Qualsevol<br>
            <input type="submit" value="CERCA">
        </form>
    </div>
    <?php } ?>
</body>
</html>