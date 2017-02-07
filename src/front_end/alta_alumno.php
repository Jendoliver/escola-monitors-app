<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alta alumne</title>
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
                <h1><em>Alta d'un nou alumne</em></h1>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row"><br><br></div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Introdueix les dades de l'alumne <em>(en cas de ser un alumne existent que s'inscriu a un altre curs, omplir el formulari igualment posant el codi corresponent)</em></h3></div> <!-- TO DO: MODIFICAR ESTO CON JS PARA QUE NO SEA TAN COÑAZO, MARCAR "EL ALUMNO YA EXISTE" E INTRODUCIR SOLO CODIGO CURSO Y DNI-->
                    <div class="main-container panel-body">
                        <form action="../back_end/insertor.php" method="POST">
    		                <div class="modal-body">
    		                    <div id="mod_curs">
                                    <div id="mod_curs-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="mod_curs-msg">Informació de curs (introdueix el codi o el nom del curs):</span>
                                </div>
    				    		<input class="form-control" type="number" min="1" name="codi_curs" placeholder="Codi de curs"><br>
    				    		<select class="form-control" name="codi_curs">
    				    		    <option value="NONE" default>Tria el nom del curs...</option>
    				    		    <?php // PARCHAKO
    				    		    $con = conectar("escoladeb1735408");
    				    		    $query = "SELECT id_curso, tipo_curso, modalidad, fecha_ini FROM Curso;";
    				    		    if($res = mysqli_query($con, $query))
    				    		    {
    				    		        if($row = mysqli_fetch_assoc($res))
    				    		        {
    				    		            do
    				    		            {
    				    		                $option = "Curs ";
        				    		            $i = 0;
        				    		            foreach($row as $key => $value)
        				    		            {
        				    		                if($i == 0)
        				    		                {
        				    		                    $idcurso = $value;
        				    		                }
        				    		                else if($i == 1)
        				    		                {
        				    		                    switch($value)
        				    		                    {
        				    		                        case 0: $option .= "Monitor"; break;
        				    		                        case 1: $option .= "Director"; break;
        				    		                        case 2: $option .= "Premonitor"; break;
        				    		                        case 3: $option .= "Altres"; break;
        				    		                        default: echo "ERRORAKO I=1";
        				    		                    }
        				    		                }
        				    		                else if($i == 2)
        				    		                {
        				    		                    switch($value)
        				    		                    {
        				    		                        case 0: $option .= " Matí "; break;
        				    		                        case 1: $option .= " Tarda "; break;
        				    		                        case 2: $option .= " Cap de setmana "; break;
        				    		                        case 3: $option .= " Intensiu "; break;
        				    		                        default: echo "ERRORAKO I=2";
        				    		                    }
        				    		                }
        				    		                else if($i == 3)
        				    		                {
        				    		                    $option .= $value;
        				    		                }
        				    		                $i++;
        				    		            }
        				    		            echo "<option value='$idcurso'>$option</option>";
    				    		            } while ($row = mysqli_fetch_assoc($res));
    				    		        }
    				    		    }
    				    		    ?> <!-- PARCHAKO FIN -->
    				    		</select><br>
    				    		<div id="dadespersonals">
                                    <div id="dadespersonals-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="dadespersonals-msg">Dades personals:</span>
                                </div>
    				    		<input class="form-control" type="text" name="dni_alumne" maxlength="9" placeholder="DNI de l'alumne" required>
    				    		<input class="form-control" type="text" maxlength="30" name="nom" placeholder="Nom" required>
    				    		<input class="form-control" type="text" maxlength="30" name="cognom1" placeholder="Primer cognom" required>
    				    		<input class="form-control" type="text" maxlength="30" name="cognom2" placeholder="Segon cognom">
    				    		<input class="form-control" type="text" maxlength="100" name="direccio" placeholder="Direcció">
    				    		<input class="form-control" type="text" minlength="9" maxlength="15" name="telefon" placeholder="Telèfon">
    				    		<input class="form-control" type="email" maxlength="100" name="email_alumne" placeholder="Email"><br>
    				    		<div id="datanaixement">
                                    <div id="datanaixement-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="datanaixement-msg">Data de naixement:</span>
                                </div>
                                <input class="form-control" type="date" name="data_naixement">
                            </div>
				    		<div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Alta alumne</button>
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