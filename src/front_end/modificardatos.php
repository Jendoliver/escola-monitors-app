<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar dades</title>
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
            <div class="row"> <!-- Imagen -->
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <header><a href="homepage.php"><img src="img/escolamonitorslogo.png" class="img-responsive center"></img></a></header>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row"> <!-- Tabla según de donde se venga -->
                <?php
                
                if(isset($_POST["curso"])) // caso modificar curso
                {
                    $code = $_POST["idcurso"]; // pasamos a $code el codigo de curso a modifcar, aka la primary
                    ?>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Estàs modificant el curs de codi: <?php echo $code; ?></h3></div>
                            <div class="main-container panel-body">
                                <form action="../back_end/updater.php" method="POST">
            		                <div class="modal-body">
            		                    <input type="hidden" name="code" value="<?php echo $code?>">
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
                                        <input class="form-control" type="text" maxlength="50" name="lugar"><br>
                                        <div id="date_end">
                                            <div id="date_end-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="date_end-msg">Preu del curs:</span>
                                        </div>
                                        <input class="form-control" type="number" min="0" name="preu" placeholder="€" required>
                    		    	</div>
            				        <div class="modal-footer">
                                        <input type="submit" name="curs" class="btn btn-success btn-lg btn-block" value="Actualitzar curs">
            				        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <footer></footer>
                <?php    
                }
                else if(isset($_POST["alumnos"])) // caso visualizar alumnos de un curso
                { ?>
                <div class="col">
                    <?php
                    $code = $_POST["idcurso"];
                    showAlumnosCurso($code);
                    ?>
                </div>
                <?php    
                }
                else if(isset($_POST["personal"])) // caso modificar datos personales alumno
                {
                    $dni = $_POST["dni"];
                    ?>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Estàs modificant la informació personal de l'alumne amb DNI: <?php echo $dni; ?></h3></div>
                            <div class="main-container panel-body">
                                <form action="../back_end/updater.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="dni" value="<?php echo $dni;?>"> <!-- para updater.php -->
                                        <div id="mod_curs">
                                            <div id="mod_curs-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="mod_curs-msg">Noves dades personals:</span>
                                        </div>
                                        <input class="form-control" type="text" maxlength="30" name="nom" placeholder="Nom" required>
                			    		<input class="form-control" type="text" maxlength="30" name="cognom1" placeholder="Primer cognom" required>
                			    		<input class="form-control" type="text" maxlength="30" name="cognom2" placeholder="Segon cognom">
                			    		<input class="form-control" type="text" maxlength="100" name="direccio" placeholder="Direcció">
                			    		<input class="form-control" type="text" minlength="9" maxlength="15" name="telefon" placeholder="Telèfon">
                			    		<input class="form-control" type="email" maxlength="100" name="email_alumne" placeholder="Email"><br>
                			    		<div id="mod_curs">
                                            <div id="mod_curs-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="mod_curs-msg">Nova data de naixement:</span>
                                        </div>
                                        <input class="form-control" type="date" name="data_naixement">
            			    		</div>
            			    		<div class="modal-footer">
                                        <div>
                                            <input type="submit" class="btn btn-success btn-lg btn-block" name="personal" value="Modificar alumne">
                                        </div>
            			            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <footer></footer>
                <?php
                }
                else if(isset($_POST["expedient"])) // caso modificar expediente alumno
                {
                    $dni = $_POST["dni"];
                    ?>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Estàs modificant l'expedient de l'alumne amb DNI: <?php echo $dni; ?></h3></div>
                            <div class="main-container panel-body">
                                <form action="../back_end/updater.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="dni" value="<?php echo $dni;?>">
                                        <div id="qual-teor">
                                            <div id="qual-teor-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="qual-teor-msg">Qualificació de la part teòrica:</span>
                                        </div>
                                        <label class="radio-inline"><input type="radio" name="teorica" value="0" required>Sense qualificar</label>
                                        <label class="radio-inline"><input type="radio" name="teorica" value="1" required>Pendent</label>
                                        <label class="radio-inline"><input type="radio" name="teorica" value="2" required>Apte</label>
                                        <label class="radio-inline"><input type="radio" name="teorica" value="3" required>No apte</label><br><br>
                                        <div id="qual-prac">
                                            <div id="qual-prac-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="qual-prac-msg">Qualificació de la part pràctica:</span>
                                        </div>
                                        <label class="radio-inline"><input type="radio" name="practica" value="0" required>Sense qualificar</label>
                                        <label class="radio-inline"><input type="radio" name="practica" value="1" required>Pendent</label>
                                        <label class="radio-inline"><input type="radio" name="practica" value="2" required>Apte</label>
                                        <label class="radio-inline"><input type="radio" name="practica" value="3" required>No apte</label><br><br>
                                        <div id="estat-mem">
                                            <div id="estat-mem-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="estat-mem-msg">Estat de la memòria:</span>
                                        </div>
                                        <label class="radio-inline"><input type="radio" name="memoria" value="0" required>No entregada</label>
                                        <label class="radio-inline"><input type="radio" name="memoria" value="1" required>Entregada</label><br><br>
                                        <div id="qualif-fin">
                                            <div id="qualif-fin-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="qualif-fin-msg">Qualificació final:</span>
                                        </div>
                                        <label class="radio-inline"><input type="radio" name="aprovat" value="0" required>Pendent</label>
                                        <label class="radio-inline"><input type="radio" name="aprovat" value="1" required>No apte</label>
                                        <label class="radio-inline"><input type="radio" name="aprovat" value="2" required>Apte</label><br><br>
                                        <div id="data-conv">
                                            <div id="data-conv-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="data-conv-msg">Data de la convocatòria <em>(en cas de tenir-ne, sino no modificar)</em>:</span>
                                        </div>
                                        <input type="date" class="form-control" name="convocatoria" value="0000-00-00"><br><br>
                                        <div id="num-titol">
                                            <div id="num-titol-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="num-titol-msg">Número de títol <em>(en cas de tenir-lo, sino deixar a 0)</em>:</span>
                                        </div>
                                        <input type="number" class="form-control" name="numtitol" value="0" placeholder="Número de títol"><br>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success btn-lg btn-block" name="expedient" value="Actualitzar expedient">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <footer></footer>
                <?php
                }
                else if(isset($_POST["deutes"])) // caso modificar deudas alumno
                {
                    $dni = $_POST["dni"];
                    ?>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Estàs modificant les deutes de l'alumne amb DNI: <?php echo $dni; ?></h3></div>
                            <div class="main-container panel-body">
                                <form action="../back_end/updater.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="dni" value="<?php echo $dni;?>">
                                        <div id="data-conv">
                                            <div id="data-conv-msg" class="glyphicon glyphicon-chevron-right"></div>
                                            <span id="data-conv-msg">Diners que deu l'alumne:</span>
                                        </div>
                                        <input type="number" class="form-control" name="money" min="0" placeholder="€" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success btn-lg btn-block" name="deutes" value="Actualitzar deutes">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <footer></footer>
                <?php
                }
                else
                    errorModificar();
                ?>
            </div>
        </div>
    <?php } ?>
</body>
</html>