<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="../css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <title>Gestió d'alumnes</title>
    <script type="text/javascript" src="formgestioalumnes.js"></script>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <div class="container-fluid">
        <div class="row"> <!-- Imagen -->
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <header><a href="homepage.php"><img src="img/escolamonitorslogo.png" class="img-responsive center"></img></a></header>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"> <!-- Título sección -->
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1>GESTIÓ D'ALUMNES</h1>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"><br><br></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default"> <!-- Buscar alumne en concret -->
                    <div class="panel-heading"><h3>Buscar alumne</h3></div>
                    <div class="main-container panel-body">
                        <form action="../back_end/selector.php" method="POST"> <!-- Formulari de cerca -->
    		                <div class="modal-body">
    				    		<div id="div-login-msg">
                                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-login-msg">Selecciona el tipus de cerca:</span>
                                </div>
    				    		<label class="radio-inline"><input type="radio" name="tipo" value="nom" onclick="nom()" required>Per Nom</label>
    				    		<label class="radio-inline"><input type="radio" name="tipo" value="email" onclick="email()" required>Per Email</label>
    				    		<label class="radio-inline"><input type="radio" name="tipo" value="dni" onclick="dni()" required>Per DNI</label>
    				    		<label class="radio-inline"><input type="radio" name="tipo" value="tel" onclick="tel()" required>Per Telèfon</label><br><br>
    				    		<div id="datainput"></div>
            		    	</div>
    				        <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Cerca</button>
                                </div>
    				        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default"> <!-- Llistat morosos/aprovats -->
                    <div class="panel-heading"><h3>Llistat de morosos / aprovats</h3></div>
                    <div class="main-container panel-body">
		                <div class="modal-body">
                            <div>
                                <form action="../back_end/selector.php" method="POST"><button type="submit" name="morosos" class="btn btn-success btn-lg btn-block">Llistat de morosos</button></form><br><br><br>
                                <form action="../back_end/selector.php" method="POST"><button type="submit" name="aprobados" class="btn btn-success btn-lg btn-block">Llistat d'aprovats</button></form>
                            </div>
        		    	</div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <footer></footer>
    </div>
    
    <?php } ?>
</body>
</html>