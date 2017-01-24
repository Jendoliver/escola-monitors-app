<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar dades</title>
</head>
<body>
    <?php
    require_once "bbdd_lib.php";
    
    if(isset($_POST["submit"])) // $_POST["submit"] contiene el tipo de modify, alumno o curso
    {
        if($_POST["submit"] == "id_curso") // caso modificar curso
        {
            session_start();
            $code = $_SESSION["primary"] // pasamos a $code el codigo de curso a modifcar, aka la primary
            ?>
            <header><img src="img/escolamonitorslogo.png"></img></header>
            <h1>Modificar curs: <?php echo $code; ?></h1>
            <div class="main-container">
                Buscar alumne:
                <form action="selector.php" method="POST">
                    Tipus de cerca: <input type="radio" name="tipo" value="nom" required> Per Nom <input type="radio" name="tipo" value="email" required> Per Email <input type="radio" name="tipo" value="dni" required> Per DNI <input type="radio" name="tipo" value="tel" required> Per Telèfon
                    <input type="text" name="data" placeholder="Introdueix aqui les dades..." required>
                    <input type="submit" value="CERCA">
                </form><br><br>
                
                Cercar alumnes que no han pagat: <input type="submit" name="morosos" value="CERCA" formaction="selector.php"><br>
                Cercar alumnes aprovats: <input type="submit" name="aprobados" value="CERCA" formaction="selector.php">
            </div>
            <footer></footer>
            
        <?php    
        }
    }
    else
        errorModificar();
    ?>
</body>
</html>