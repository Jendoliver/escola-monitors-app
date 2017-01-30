<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar dades</title>
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="../css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row"> <!-- Imagen -->
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <header><a href="homepage.php"><img src="img/escolamonitorslogo.png" class="img-responsive center"></img></a></header>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"> <!-- Tabla según de donde se venga -->
            <?php
            require_once "../back_end/bbdd_lib.php";
            
            if(isset($_POST["curso"])) // caso modificar curso
            {
                $code = $_POST["idcurso"]; // pasamos a $code el codigo de curso a modifcar, aka la primary
                ?>
                <h1>Estàs modificant el curs de codi: <?php echo $code; ?></h1>
                <div class="main-container">
                    <form action="../back_end/updater.php" method="POST">
                        <input type="hidden" name="code" value="<?php echo $code;?>">
                        Nou tipus del curs*: <input type=radio name="tipus_curs" value="0" required> Monitor <input type=radio name="tipus_curs" value="1" required> Director<br>
                        Nova modalitat*: <input type=radio name="modalitat" value="mati" required> Matí <input type=radio name="modalitat" value="tarda" required> Tarda <input type=radio name="modalitat" value="finde" required> Cap de setmana <input type=radio name="modalitat" value="intensiu" required> Intensiu<br>
                        Nova data d'inici del curs*: <input type="date" name="fecha_ini" required><br>
                        Nova data de finalització del curs*: <input type="date" name="fecha_fin" required><br>
                        Nou lloc on es realitza el curs: <input type="text" name="lugar"><br>
                        Nou preu del curs*: <input type=number min="0" max="10000" name="preu" required> €<br>
                        <input type="submit" name="curs" value="ACTUALITZAR CURS">
                    </form>
                </div>
                <footer></footer>
            <?php    
            }
            else if(isset($_POST["alumnos"])) // caso visualizar alumnos de un curso
            { ?>
            <div class="col">
                <?php
                $code = $_POST["idcurso"];
                showAlumnosCurso($code);
                ?>
            </div>
            <?php    
            }
            else if(isset($_POST["personal"])) // caso modificar datos personales alumno
            {
                $dni = $_POST["dni"];
                ?>
                <h1>Estàs modificant la informació personal de l'alumne amb DNI: <?php echo $dni; ?></h1>
                <div class="main-container">
                    <form action="../back_end/updater.php" method="POST">
                        <input type="hidden" name="dni" value="<?php echo $dni;?>">
                        Nou nom Alumne: <input type="text" maxlength="30" name="nom" placeholder="Nom" required>  Primer cognom: <input type="text" maxlength="30" name="cognom1" placeholder="Cognom 1" required>  Segon cognom: <input type="text" maxlength="30" name="cognom2" placeholder="Cognom 2"><br>
                        Nova data de naixement: <input type="date" name="data_naixement"><br>
                        Nova direcció: <input type="text" name="direccio"><br>
                        Nou telèfon: <input type="text" minlength="9" name="telefon"><br>
                        Nou email: <input type="email" name="email_alumne"><br>
                        <input type="submit" name="personal" value="ACTUALITZAR ALUMNE">
                    </form>
                </div>
                <footer></footer>
            <?php
            }
            else if(isset($_POST["expedient"])) // caso modificar expediente alumno
            {
                $dni = $_POST["dni"];
                ?>
                <h1>Estàs modificant l'expedient de l'alumne amb DNI: <?php echo $dni; ?></h1>
                <div class="main-container">
                    <form action="../back_end/updater.php" method="POST">
                        <input type="hidden" name="dni" value="<?php echo $dni;?>">
                        Qualificació de la part teòrica: <input type="radio" name="teoria" value="0" required> Sense qualificar <input type="radio" name="teoria" value="1" required> Pendent <input type="radio" name="teoria" value="2" required> Apte <input type="radio" name="teoria" value="3" required> No apte<br>
                        Qualificació de la part pràctica: <input type="radio" name="practica" value="0" required> Sense qualificar <input type="radio" name="practica" value="1" required> Pendent <input type="radio" name="practica" value="2" required> Apte <input type="radio" name="practica" value="3" required> No apte<br>
                        Data de la convocatòria: <input type="date" name="convocatoria"><br>
                        Estat de la memòria: <input type="radio" name="memoria" value="0" required> No entregada <input type="radio" name="memoria" value="1" required> Entregada<br>
                        Qualificació final: <input type="radio" name="aprovat" value="0" required> Pendent <input type="radio" name="aprovat" value="1" required> No apte <input type="radio" name="aprovat" value="2" required> Apte<br>
                        <input type="submit" name="expedient" value="ACTUALITZAR EXPEDIENT">
                    </form>
                </div>
                <footer></footer>
            <?php
            }
            else if(isset($_POST["deutes"])) // caso modificar deudas alumno
            {
                $dni = $_POST["dni"];
                ?>
                <h1>Estàs modificant les deutes de l'alumne amb DNI: <?php echo $dni; ?></h1>
                <div class="main-container">
                    <form action="../back_end/updater.php" method="POST">
                        <input type="hidden" name="dni" value="<?php echo $dni;?>">
                        Diners que deu l'alumne: <input type="number" name="money" min="0" required><br>
                        <input type="submit" name="deutes" value="ACTUALITZAR DEUTES">
                    </form>
                </div>
                <footer></footer>
            <?php
            }
            else
                errorModificar();
            ?>
        </div>
    </div>    
</body>
</html>