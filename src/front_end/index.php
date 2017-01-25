<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autentificació de l'administrador</title>
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="../css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>
</head>
<body>
    <div class="container-fluid">
    <?php
    require_once "../back_end/bbdd_lib.php";
    if(!empty($_POST))
    {
        if(checkadmin($_POST["username"], $_POST["password"]))
        {
            session_start();
            $_SESSION["token"] = 1;
            header('Location: homepage.php');
        }
        else
        {
            errorLogin();
        }
    }
    else
    {?>
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <header><img src="img/escolamonitorslogo.png" class="img-responsive center"></img></header>
    </div>
    <div class="col-md-3"></div>
    </div>
    <div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
    <div class="panel panel-default">
<div class="panel-heading"><h3>Autentificació de l'administrador</h3></div>
    <div class="main-container panel-body">
        Introdueix les teves credencials d'administrador:
        <form action="" method="POST">
            Usuari: <input type="text" name="username"/><br>
            Contrasenya: <input type="password" name="password"/><br>
            <input type="submit" value="ACCEDEIX"/>
        </form>
    </div>
    </div>
    </div>
    <div class="col-md-3"></div>
    </div>
    
    </div>
    <?php } ?>
</body>
</html>