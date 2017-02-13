<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cerca i gestió de cursos</title>
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="../css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>
    <?php 
    require_once "../back_end/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <header><a href="homepage.php"><img src="img/escolamonitorslogo.png" class="img-responsive center"></img></a></header>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"> <!-- Título sección -->
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1><em>Cerca de cursos</em></h1>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"><br><br></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default"> <!-- Buscar un curs en concret -->
                    <div class="panel-heading"><h3>Cercar un únic curs mitjançant el seu codi</h3></div>
                    <div class="main-container panel-body">
                        <form action="../back_end/selector.php" method="POST"> <!-- Formulari de cerca -->
        	                <div class="modal-body">
        			    		<div id="div-login-msg">
                                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-login-msg">Codi de curs:</span>
                                </div>
                                <input class="form-control" type="number" min="1" name="codi_curs">
                            </div>
        			        <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Cercar curs</button>
                                </div>
        			        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default"> <!-- Buscar diversos cursos -->
                    <div class="panel-heading"><h3>Cercar diversos cursos</h3></div>
                    <div class="main-container panel-body">
                        <form action="../back_end/selector.php" method="POST">
                            <div class="modal-body">
                                <div id="tipus_curs">
                                    <div id="tipus_curs-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="tipus_curs-msg">Tipus del curs:</span>
                                </div>
            		    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="0" required>Monitor</label>
            		    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="1" required>Director</label>
            		    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="2" required>Premonitor</label>
            		    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="3" required>Altres</label>
            		    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="ANY" checked required>Qualsevol</label><br><br>
            		    		<div id="mod_curs">
                                    <div id="mod_curs-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="mod_curs-msg">Modalitat del curs:</span>
                                </div>
                                <label class="radio-inline"><input type="radio" name="modalitat_curs" value="0" required>Matí</label>
            		    		<label class="radio-inline"><input type="radio" name="modalitat_curs" value="1" required>Tarda</label>
            		    		<label class="radio-inline"><input type="radio" name="modalitat_curs" value="2" required>Finde</label>
            		    		<label class="radio-inline"><input type="radio" name="modalitat_curs" value="3" required>Intensiu</label>
            		    		<label class="radio-inline"><input type="radio" name="modalitat_curs" value="ANY" checked required>Qualsevol</label><br><br>
            		    		<div id="date">
                                    <div id="date-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="date-msg">Any del curs:</span>
                                </div>
                                <input class="form-control" type="number" name="data_curs" minlength="4" maxlength="4">
                                <input type="radio" name="data_curs" value="ANY"> Qualsevol
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Cercar cursos</button>
                                </div>
        			        </div>
        			    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <?php } ?>
</body>
</html>