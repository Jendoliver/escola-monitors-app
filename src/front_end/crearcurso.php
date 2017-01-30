<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creació de curs</title>
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
                <h1><em>Creació d'un nou curs</em></h1>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"><br><br></div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Introdueix les dades del nou curs</h3></div>
                    <div class="main-container panel-body">
                        <form action="../back_end/insertor.php" method="POST">
    		                <div class="modal-body">
    				    		<div id="tipus_curs">
                                    <div id="tipus_curs-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="tipus_curs-msg">Tipus del curs:</span>
                                </div>
    				    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="0" required>Monitor</label>
    				    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="1" required>Director</label>
    				    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="2" required>Premonitor</label>
    				    		<label class="radio-inline"><input type="radio" name="tipus_curs" value="3" required>Altres</label><br><br>
    				    		<div id="mod_curs">
                                    <div id="mod_curs-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="mod_curs-msg">Modalitat del curs:</span>
                                </div>
                                <label class="radio-inline"><input type="radio" name="modalitat" value="0" required>Matí</label>
    				    		<label class="radio-inline"><input type="radio" name="modalitat" value="1" required>Tarda</label>
    				    		<label class="radio-inline"><input type="radio" name="modalitat" value="2" required>Finde</label>
    				    		<label class="radio-inline"><input type="radio" name="modalitat" value="3" required>Intensiu</label><br><br>
    				    		<div id="date">
                                    <div id="date-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="date-msg">Data d'inici del curs:</span>
                                </div>
                                <input class="form-control" type="date" name="fecha_ini" required><br>
                                <div id="date_end">
                                    <div id="date_end-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="date_end-msg">Data de finalització del curs:</span>
                                </div>
                                <input class="form-control" type="date" name="fecha_fin" required><br>
                                <div id="date_end">
                                    <div id="date_end-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="date_end-msg">Lloc on es realitza el curs:</span>
                                </div>
                                <input class="form-control" type="text" name="lugar"><br>
                                <div id="date_end">
                                    <div id="date_end-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="date_end-msg">Preu del curs:</span>
                                </div>
                                <input class="form-control" type="number" min="0" name="preu" placeholder="€" required>
            		    	</div>
    				        <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Crear curs</button>
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