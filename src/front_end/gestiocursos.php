<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="../css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <title>Gestió de cursos</title>
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
                <h1>Gestió de cursos</h1>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"><br><br></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="panel panel-default"> <!-- Crear un curs -->
                    <div class="panel-heading"><h3>Crear un curs</h3></div>
                    <div class="main-container panel-body">
		                <div class="modal-body">
                            <blockquote class="blockquote">
                                <p>Selecciona aquesta opció per a crear un nou curs. Tria el tipus de curs, la modalitat, la seva data d'inici i final, el lloc on es realitzarà i el seu preu. <mark>No oblidis apuntar el codi de curs que es generarà!</mark></p><br>
                                <footer><em>El primer pas abans de donar d'alta alumnes</em></footer>
                            </blockquote>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <form action="crearcurso.php" method="POST"><button type="submit" class="btn btn-primary btn-lg btn-block">Crear nou curs</button></form>
                            </div>
				        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default"> <!-- Donar d'alta alumne a curs -->
                    <div class="panel-heading"><h3>Donar d'alta alumnes</h3></div>
                    <div class="main-container panel-body">
		                <div class="modal-body">
		                    <blockquote>
                                <p>Des d'aquí es donen d'alta els alumnes i s'inscriuen directament a un curs prèviament creat a la secció de l'esquerra <em>(mitjançant el codi de curs).</em> Necessitaràs el seu DNI, nom i cognoms, data de naixement, direcció i email.</p>
                                <footer><em>Un cop hagis creat un curs, dóna-hi d'alta alumnes</em></footer>
                            </blockquote>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <form action="alta_alumno.php" method="POST"><button type="submit" class="btn btn-primary btn-lg btn-block">Inscriure nou alumne</button></form>
                            </div>
				        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default"> <!-- Cerca i gestió de cursos -->
                    <div class="panel-heading"><h3>Cerca i gestió de cursos</h3></div>
                    <div class="main-container panel-body">
		                <div class="modal-body">
		                    <blockquote>
                                <p>En aquesta secció podràs cercar els cursos que ja hagis creat filtrant-los per tipus, modalitat i data d'inici. A més, també pots modificar-ne la seva informació i visualitzar els alumnes que hi ha inscrits</p><br>
                                <footer><em>Quants cursos tenim? Qui els fa?</em></footer>
                            </blockquote>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <form action="buscarcurso.php" method="POST"><button type="submit" class="btn btn-primary btn-lg btn-block">Gestionar cursos</button></form>
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