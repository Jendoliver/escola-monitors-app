<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alta alumne</title>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <header><img src="img/escolamonitorslogo.png"></img></header>
    <h1>Alta alumne</h1>
    <div class="main-container">
        <!-- MOLARIA JS QUE ADAPTASE EL FORMULARIO DEL ALUMNO SEGUN SI SELECCIONA EL CURSO SEGUN EL CÓDIGO-->
        Afegir alumne a curs amb codi de curs:
        <form action="../back_end/insertor.php" method="POST">
            Codi de curs: <input type="number" min="1" name="codi_curs"><br><br>
            
            DNI Alumne: <input type="text" minlength="9" maxlength="9" name="dni_alumne" required><br>
            Nom Alumne: <input type="text" maxlength="30" name="nom" placeholder="Nom" required>  Primer cognom: <input type="text" maxlength="30" name="cognom1" placeholder="Cognom 1" required>  Segon cognom: <input type="text" maxlength="30" name="cognom2" placeholder="Cognom 2" required><br>
            Data de naixement: <input type="date" name="data_naixement"><br>
            Direcció: <input type="text" name="direccio"><br>
            Telèfon: <input type="text" minlength="9" maxlength="9" name="telefon"><br>
            Email: <input type="email" name="email_alumne"><br>
            <input type="submit" value="DONAR D'ALTA ALUMNE">
        </form><br><br>
    </div>
    <footer></footer>
    <?php } ?>
</body>
</html>