<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autentificació de l'administrador</title>
</head>
<body>
    <?php
    require_once "../back_end/bbdd_lib.php";
    if(!empty($_POST))
    {
        if(checkadmin($_POST["username"], $_POST["password"]))
        {
            session_start();
            $_SESSION["token"] = 1;
            header('Location: homepage.php');
            echo "Pasa naf";
        }
        else
            errorLogin();
    }
    else
    {?>
    <header><img src="img/escolamonitorslogo.png"></img></header>
    <h1>Autentificació de l'administrador</h1>
    <div class="main-container">
        Introdueix les teves credencials d'administrador:
        <form action="" method="POST">
            Usuari: <input type="text" name="username"/><br>
            Contrasenya: <input type="password" name="password"/><br>
            <input type="submit" value="ACCEDEIX"/>
        </form>
    </div>
    <?php } ?>
</body>
</html>