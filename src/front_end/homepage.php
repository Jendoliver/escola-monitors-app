<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="../css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <title>Gestió de l'Escola</title>
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
                <header><img src="img/escolamonitorslogo.png" class="img-responsive center"></img></header>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"> <!-- Título sección -->
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1><em>Pàgina principal</em></h1>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"><br><br></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default"> <!-- Gestionar alumnes -->
                    <div class="panel-heading"><h3>Gestió d'alumnes</h3></div>
                    <div class="main-container panel-body">
		                <div class="modal-body">
                            <blockquote class="blockquote-reverse">
                                <p>Accedeix a aquesta secció per a realitzar cerces d'un alumne en concret, dels alumnes que tenen deutes pendents i dels alumnes aprovats. Des de les taules resultants podràs modificar la informació personal d'un alumne, el seu expedient i les seves deutes.</p>
                                <footer><em>Cercar i modificar alumnes, llistat de morosos i aprovats</em></footer>
                            </blockquote>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <a href="gestioalumnes.php" class="btn btn-primary btn-lg btn-block">Gestionar alumnes</a>
                            </div>
				        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default"> <!-- Gestionar cursos -->
                    <div class="panel-heading"><h3>Gestió de cursos</h3></div>
                    <div class="main-container panel-body">
		                <div class="modal-body">
		                    <blockquote>
                                <p>En aquesta secció podràs donar d'alta cursos, alumnes <em>(introduint-los directament a un curs prèviament creat)</em> i cercar cursos, tant com per visualitzar els alumnes que hi pertànyen com per modificar-los des de les taules resultants.</p><br>
                                <footer><em>Donar d'alta cursos, donar d'alta alumnes, cercar i modificar cursos</em></footer>
                            </blockquote>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <a href="gestiocursos.php" class="btn btn-primary btn-lg btn-block">Gestionar cursos</a>
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