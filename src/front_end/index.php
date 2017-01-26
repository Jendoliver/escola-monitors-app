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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <header><img src="img/escolamonitorslogo.png" class="img-responsive center"></img></header>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Autentificació de l'administrador</h3></div>
                    <div class="main-container panel-body">
                        <form id="login-form" action="" method="POST">
    		                <div class="modal-body">
    				    		<div id="div-login-msg">
                                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-login-msg">Introdueix les teves credencials d'administrador:</span>
                                </div>
    				    		<input id="login_username" class="form-control" type="text" placeholder="Nom d'usuari" name="username" required>
    				    		<input id="login_password" class="form-control" type="password" placeholder="Contrasenya" name="password" required>
            		    	</div>
    				        <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Accedeix</button>
                                </div>
    				        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <?php } ?>
</body>
</html>