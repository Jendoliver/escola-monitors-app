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
    <header><img src=""></img></header>
    <h1>Cerca de cursos</h1>
    <div class="main-container">
        <!-- MOLARIA JS QUE ADAPTASE EL FORMULARIO SEGUN SI SE BUSCA EL CURSO SEGUN EL CÓDIGO O TIPO+MODALIDAD+AÑO -->
        Cercar curs mitjançant el seu codi:
        <form action="../back_end/selector.php" method="POST">
            Codi de curs: <input type="number" min="1" name="codi_curs"><br>
            <input type="submit" value="CERCA">
        </form>
        
        Cercar curs mitjançant tipus, modalitat i any del curs:
        <form action="../back_end/selector.php" method="POST">
            Tipus de curs: <input type=radio name="tipus_curs" value="M" required> Monitor <input type=radio name="tipus_curs" value="D" required> Director <input type=radio name="tipus_curs" value="ANY" required> Qualsevol<br>
            Modalitat: <input type=radio name="modalitat_curs" value="mati" required> Matí <input type=radio name="modalitat_curs" value="tarda" required> Tarda <input type=radio name="modalitat_curs" value="finde" required> Cap de setmana <input type=radio name="modalitat_curs" value="intensiu" required> Intensiu <input type=radio name="modalitat_curs" value="ANY" required> Qualsevol<br>
            Any del curs (deixar en blanc per qualsevol any): <input type=number min="2017" max="3000" name="any_curs"><br>
            <input type="submit" value="CERCA">
        </form>
    </div>
    <?php } ?>
</body>
</html>