<?php
/*
*
* bbdd_lib.php: LIBRERÍA DE FUNCIONES Y PROCEDIMIENTOS CORRESPONDIENTES A LAS CONSULTAS A LA BASE DE DATOS
*   Autor: Jhen D'Òliver
*/

require_once "error_lib.php";

/******FUNCIONES*****/

//BÁSICAS
function conectar($db) // Todo un clásico
{
    $conexion = mysqli_connect("localhost", "root", "", $db) or
        die("No se ha podido conectar a la BBDD");
    return $conexion;
}

function desconectar($con) // Otra que tal
{
    mysqli_close($con);
}

//AUTENTICACIÓN
function checkadmin($user, $pass) // Función que comprueba que el login es correcto
{
    $con = conectar("edm");
    $query = "SELECT * FROM Admin WHERE username = '$user' AND password = '$pass';";
    if($res = mysqli_query($con, $query)) // si no hay error
    {
        if(mysqli_num_rows($res)) // si hay alguna tupla así
        {
            desconectar($con);
            return 1; // login correcto
        }
        else
        {
            desconectar($con);
            return 0; // login incorrecto
        }
    }
    else
    {
        errorConsulta();
        desconectar($con);
    }
}

function auth() // Función que comprueba que se accede a la web logueado como admin (1 - OK, 0 - No logueado)
{
    session_start();
    if($_SESSION["token"] == 1)
        return 1;
    else
        return 0;
}

//INSERTS
function insertarCurso($tipo, $mod, $fecha_ini, $fecha_fin, $lugar, $precio) // FUNCIÓN QUE INSERTA UN CURSO EN LA TABLA CURSO, DEVUELVE CÓDIGO DE CURSO (PRIMARY KEY) Ó 0 EN CASO DE ERROR
{
    $code = createCode();
    $conexion = conectar("edm");
    $insert = "INSERT INTO Curso(`id_curso`, `tipo_curso`, `modalidad`, `fecha_ini`, `fecha_fin`, `lugar`, `precio`) VALUES($code, $tipo, $mod, '$fecha_ini', '$fecha_fin', '$lugar', $precio);";
    if(mysqli_query($conexion, $insert))
    {
        desconectar($conexion);
        return $code;
    }
    else
    {
        echo mysqli_error($conexion);
        desconectar($conexion);
        return 0;
    }
}

function insertarAlumno($codigo, $dni, $nom, $ape1, $ape2, $nacim, $dir, $tel, $email) // FUNCIÓN QUE INSERTA A UN ALUMNO EN LA TABLA ALUMNO Y LO RELACIONA CON EL CURSO DE CODIGO $code --- DEVUELVE 0 SI ERROR
{
    if(!alumnoExists($dni)) // el alumno es nuevo
    {
        $conexion = conectar("edm");
        $insert = "INSERT INTO Alumno(`dni`,`nombre`,`ape1`,`ape2`,`fecha_nacimiento`,`direccion`,`telefono`,`email`) VALUES('$dni', '$nom', '$ape1', '$ape2', '$nacim', '$dir', '$tel', '$email');";
        if(mysqli_query($conexion, $insert))
        {
            $insert = "INSERT INTO Inscrito VALUES('$dni', $codigo);";
            if(mysqli_query($conexion, $insert))
            {
                desconectar($conexion);
                return 1;
            }
            else
            {
                desconectar($conexion);
                errorConsulta();
            }
        }
        else
        {
            desconectar($conexion);
            errorConsulta();
        }
    }
    else if(!alumnoIsInCurso($dni, $codigo)) // el alumno ya existe pero no en ese curso
    {
        $conexion = conectar("edm");
        $insert = "INSERT INTO Inscrito VALUES('$dni', $codigo);";
        if(mysqli_query($conexion, $insert))
        {
            desconectar($conexion);
            return 1;
        }
        else
        {
            desconectar($conexion);
            errorConsulta();
        }
    }
    else
    {
        return 0; // el alumno ya está inscrito a ese curso
    }
}

//SELECTS
function createCode() // FUNCIÓN QUE DEVUELVE UN CÓDIGO DE CURSO NUEVO
{
    $con = conectar("edm");
    $query = "SELECT id_curso FROM Curso;"; // pillamos todos los codigos
    if($res = mysqli_query($con, $query)) // si no hay error
    {
        $code = mysqli_num_rows($res) + 1; // creamos un código nuevo sumando uno al número de tuplas obtenidas
        desconectar($con);
        return $code;
    }
    else
    {
        desconectar($con);
        errorConsulta();
    }
}

//UPDATES
function updateCurso($code, $tipo, $mod, $fecha_ini, $fecha_fin, $lugar, $precio)
{
    $con = conectar("edm");
    $update = "UPDATE Curso SET tipo_curso = $tipo, modalidad = $mod, fecha_ini = '$fecha_ini', fecha_fin = '$fecha_fin', lugar = '$lugar', precio = $precio WHERE id_curso = $code;";
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        updateCorrect();
    }
    else
    {
        desconectar($con);
        errorConsulta();
    }
}

function updateAlumnoPersonal($dni, $nom, $cog1, $cog2, $dnaix, $dir, $tel, $email)
{
    $con = conectar("edm");
    $update = "UPDATE Alumno SET nombre = '$nom', ape1 = '$cog1', ape2 = '$cog2', fecha_nacimiento = '$dnaix', direccion = '$dir', telefono = '$tel', email = '$email' WHERE dni = '$dni';";
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        updateCorrect();
    }
    else
    {
        desconectar($con);
        errorConsulta();
    }
}

function updateAlumnoExpedient($dni, $teorica, $practica, $convocatoria, $memoria, $aprovat, $numtitol)
{
    $con = conectar("edm");
    $update = "UPDATE Alumno SET calificacion_teoria = $teorica, calificacion_practicas = $practica, fecha_memoria = '$convocatoria', memoria = $memoria, aprobado = $aprovat, num_titulo = $numtitol WHERE dni = '$dni';";
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        updateCorrect();
    }
    else
    {
        echo mysqli_error($con);
        desconectar($con);
        errorConsulta();
    }
}

function updateAlumnoDeutas($dni, $money)
{
    $con = conectar("edm");
    $update = "UPDATE Alumno SET dinero_debido = $money WHERE dni = '$dni';";
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        updateCorrect();
    }
    else
    {
        desconectar($con);
        errorConsulta();
    }
}

//BOOLEANAS
function cursoExists($code) // FUNCIÓN QUE DEVUELVE 1 SI EL CURSO EXISTE Y 0 SI NO
{
    $con = conectar("edm");
    $query = "SELECT id_curso FROM Curso WHERE id_curso = $code;";
    if($res = mysqli_query($con, $query)) // si la monarquia española ataca aka si no hay error
    {
        if(mysqli_num_rows($res)) // si existe el curso
        {
            desconectar($con);
            return 1;
        }
        else
        {
            desconectar($con);
            return 0;
        }
    }
    else
    {
        desconectar($con);
        errorConsulta();
    }
}

function alumnoExists($dni)
{
    $con = conectar("edm");
    $query = "SELECT dni FROM Alumno WHERE dni = '$dni';";
    if($res = mysqli_query($con, $query)) // si la monarquia española ataca aka si no hay error
    {
        if(mysqli_num_rows($res)) // si existe el alumno
        {
            desconectar($con);
            return 1;
        }
        else
        {
            desconectar($con);
            return 0;
        }
    }
    else
    {
        desconectar($con);
        errorConsulta();
    }
}

function alumnoIsInCurso($dni, $code)
{
    $con = conectar("edm");
    $query = "SELECT * FROM Inscrito WHERE dni = '$dni' AND id_curso = $code;";
    if($res = mysqli_query($con, $query)) // si la monarquia española ataca aka si no hay error
    {
        if(mysqli_num_rows($res)) // si el alumno está inscrito en el curso
        {
            desconectar($con);
            return 1;
        }
        else
        {
            desconectar($con);
            return 0;
        }
    }
    else
    {
        desconectar($con);
        errorConsulta();
    }
}


/********PROCEDIMIENTOS*********/
//SELECTS
function showCursoByCode($code) // PROCEDIMIENTO QUE MUESTRA UN SOLO CURSO CON id_curso = $code Y OPCIONES DE GESTIÓN (mostrar alumnos del curso, modificar curso //NUNCA EL CÓDIGO//)
{
    $con = conectar("edm");
    if($res = mysqli_query($con, "SELECT id_curso as 'Codi de curs', tipo_curso as 'Tipus de curs', modalidad as 'Modalitat', fecha_ini as 'Data Inici', fecha_fin as 'Data Final', lugar as 'Lloc', precio as 'Preu' FROM Curso WHERE id_curso = $code;"))
    {
        createTableCursos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showCursos($tipo, $mod, $date) // PROCEDIMIENTO QUE MUESTRA UNO O VARIOS CURSOS SEGÚN EL TIPO, MODALIDAD Y AÑO ESPECIFICADO
{
    $where = " WHERE "; // MONTAMOS LA PARTE WHERE DE LA CONSULTA
    $restric = false;
    if($tipo != "ANY")
    {
        $where .= "tipo_curso = $tipo";
        $restric = true;
    }
    if($mod != "ANY")
    {
        if($restric) // si no es la primera restricción añadimos el AND, sino igual
            $where .= " AND modalidad = '$mod'";
        else
        {
            $where .= "modalidad = '$mod'";
            $restric = true;
        }
    }
    if($date != "ANY")
    {
        if($restric)
            $where .= " AND fecha_ini = '$date'";
        else
        {
            $where .= "fecha_ini = '$date'";
            $restric = true;
        }
    }
    $where .= ";";
    $query = "SELECT id_curso as 'Codi de curs', tipo_curso as 'Tipus de curs', modalidad as 'Modalitat', fecha_ini as 'Data Inici', fecha_fin as 'Data Final', lugar as 'Lloc', precio as 'Preu' FROM Curso";
    if($restric)
        $query .= $where;
    
    $con = conectar("edm");
    if($res = mysqli_query($con, $query))
    {
        createTableCursos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showAlumnoByNom($nom, $cog1, $cog2) // TODO
{
    $where = " WHERE ";
    $restric = false;
    if($nom != "")
    {
        $where .= "nombre = '$nom'";
        $restric = true;
    }
    if($cog1 != "")
    {
        if($restric) // si no es la primera restricción añadimos el AND, sino igual
            $where .= " AND ape1 = '$cog1'";
        else
        {
            $where .= "ape1 = '$cog1'";
            $restric = true;
        }
    }
    if($cog2 != "")
    {
        if($restric)
            $where .= " AND ape2 = '$cog2'";
        else
        {
            $where .= "ape2 = '$cog2'";
            $restric = true;
        }
    }
    $where .= ";";
    $select = "SELECT dni as 'DNI', nombre as 'Nom', ape1 as 'Primer Cognom', ape2 as 'Segon Cognom', fecha_nacimiento as 'Data de naixement', direccion as 'Direcció', telefono as 'Telèfon', email, calificacion_teoria as 'Qualif. part teòrica', calificacion_practicas as 'Qualif. part pràctica', dinero_debido as 'Deutes en €', fecha_memoria as 'Data de convocatòria', memoria as 'Memòria entregada', aprobado as 'Qualif. alumne', num_titulo as 'Numero de títol' FROM Alumno";
    if($restric)
        $select .= $where;
        
    $con = conectar("edm");
    if($res = mysqli_query($con, $select))
    {
        createTableAlumnos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showAlumnoByEmail($email)
{
    $con = conectar("edm");
    $select = "SELECT dni as 'DNI', nombre as 'Nom', ape1 as 'Primer Cognom', ape2 as 'Segon Cognom', fecha_nacimiento as 'Data de naixement', direccion as 'Direcció', telefono as 'Telèfon', email, calificacion_teoria as 'Qualif. part teòrica', calificacion_practicas as 'Qualif. part pràctica', dinero_debido as 'Deutes en €', fecha_memoria as 'Data de convocatòria', memoria as 'Memòria entregada', aprobado as 'Qualif. alumne', num_titulo as 'Numero de títol' FROM Alumno WHERE email = '$email';";
    if($res = mysqli_query($con, $select))
    {
        createTableAlumnos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showAlumnoByDNI($dni)
{
    $con = conectar("edm");
    $select = "SELECT dni as 'DNI', nombre as 'Nom', ape1 as 'Primer Cognom', ape2 as 'Segon Cognom', fecha_nacimiento as 'Data de naixement', direccion as 'Direcció', telefono as 'Telèfon', email, calificacion_teoria as 'Qualif. part teòrica', calificacion_practicas as 'Qualif. part pràctica', dinero_debido as 'Deutes en €', fecha_memoria as 'Data de convocatòria', memoria as 'Memòria entregada', aprobado as 'Qualif. alumne', num_titulo as 'Numero de títol' FROM Alumno WHERE dni = '$dni';";
    if($res = mysqli_query($con, $select))
    {
        createTableAlumnos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showAlumnoByTel($tel)
{
    $con = conectar("edm");
    $select = "SELECT dni as 'DNI', nombre as 'Nom', ape1 as 'Primer Cognom', ape2 as 'Segon Cognom', fecha_nacimiento as 'Data de naixement', direccion as 'Direcció', telefono as 'Telèfon', email, calificacion_teoria as 'Qualif. part teòrica', calificacion_practicas as 'Qualif. part pràctica', dinero_debido as 'Deutes en €', fecha_memoria as 'Data de convocatòria', memoria as 'Memòria entregada', aprobado as 'Qualif. alumne', num_titulo as 'Numero de títol' FROM Alumno WHERE telefono = '$tel';";
    if($res = mysqli_query($con, $select))
    {
        createTableAlumnos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showAlumnosCurso($code)
{
    $con = conectar("edm");
    $select = "SELECT Alumno.dni as 'DNI', nombre as 'Nom', ape1 as 'Primer Cognom', ape2 as 'Segon Cognom', fecha_nacimiento as 'Data de naixement', direccion as 'Direcció', telefono as 'Telèfon', email, calificacion_teoria as 'Qualif. part teòrica', calificacion_practicas as 'Qualif. part pràctica', dinero_debido as 'Deutes en €', fecha_memoria as 'Data de convocatòria', memoria as 'Memòria entregada', aprobado as 'Qualif. alumne', num_titulo as 'Numero de títol' FROM Alumno INNER JOIN Inscrito ON Alumno.dni = Inscrito.dni WHERE Inscrito.id_curso = $code";
    if($res = mysqli_query($con, $select))
    {
        createTableAlumnos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        echo mysqli_error($con);
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showMorosos()
{
    $con = conectar("edm");
    $select = "SELECT dni as 'DNI', nombre as 'Nom', ape1 as 'Primer Cognom', ape2 as 'Segon Cognom', direccion as 'Direcció', telefono as 'Telèfon', email, dinero_debido as 'Deutes en €' FROM Alumno WHERE dinero_debido != 0;";
    if($res = mysqli_query($con, $select))
    {
        createTableAlumnos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function showAprobados()
{
    $con = conectar("edm");
    $select = "SELECT dni as 'DNI', nombre as 'Nom', ape1 as 'Primer Cognom', ape2 as 'Segon Cognom', fecha_nacimiento as 'Data de naixement', direccion as 'Direcció', telefono as 'Telèfon', email, calificacion_teoria as 'Qualif. part teòrica', calificacion_practicas as 'Qualif. part pràctica', dinero_debido as 'Deutes en €', fecha_memoria as 'Data de convocatòria', memoria as 'Memòria entregada', aprobado as 'Qualif. alumne', num_titulo as 'Numero de títol' FROM Alumno WHERE aprobado = 2;";
    if($res = mysqli_query($con, $select))
    {
        createTableAlumnos($con, $res);
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
    else
    {
        errorConsulta();
        desconectar($con);
        printBackButton();
        printHomeButton();
    }
}

function createTableCursos($con, $res) // $con = conexion bbdd, $res = resultado query
{
    if($row = mysqli_fetch_assoc($res)) //comprobamos que hay algo para evitar warning
    {
        $table = "<table class='table table-hover'>"; // ese bootstrap joder
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            $table .= "<th>$key</th>";
        }
        $table .= "<th>Modificar curs</th><th>Visualitzar alumnes</th></thead><tbody>"; // columna de botón modificar, cierre del header y apertura del body
    
        do // llenar tabla con el contenido de la query
        {
            $i = 0;
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                if($i == 0) // pillamos la primary para lanzar el modify sobre eso
                {    
                    $idcurso = $value;
                    $table .= "<td>$value</td>";
                }
                else if($i == 1)
                {
                    switch($value)
                    {
                        case 0: $table .= "<td>Monitor</td>"; break;
                        case 1: $table .= "<td>Director</td>"; break;
                        case 2: $table .= "<td>Premonitor</td>"; break;
                        case 3: $table .= "<td>Altres</td>"; break;
                        default: errorCreateTable();
                    }
                }
                else if($i == 2)
                {
                    switch($value)
                    {
                        case 0: $table .= "<td>Matí</td>"; break;
                        case 1: $table .= "<td>Tarda</td>"; break;
                        case 2: $table .= "<td>Cap de setmana</td>"; break;
                        case 3: $table .= "<td>Intensiu</td>"; break;
                        default: errorCreateTable();
                    }
                }
                else
                    $table .= "<td>$value</td>";
                $i++;
            }
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='idcurso' value='$idcurso'><input type='submit' class='btn btn-info btn-sm' name='curso' value='MODIFICAR'></form></td>"; // botón de modificar
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='idcurso' value='$idcurso'><input type='submit' class='btn btn-info btn-sm' name='alumnos' value='MOSTRAR'></form></td>";
            $table .= "</tr>";
        } while ($row = mysqli_fetch_assoc($res));
        $table .= "</tbody></table>";
        echo $table;
    }
    else
        errorNoResults();
}

function createTableAlumnos($con, $res)
{
    if($row = mysqli_fetch_assoc($res)) // checkiamos que hay resultados
    {
        $table = "<table class='table table-hover'>";
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            $table .= "<th>$key</th>";
        }
        $table .= "<th>Modificar dades personals</th><th>Modificar expedient</th><th>Modificar deutes</th></thead><tbody>"; // columna de botón modificar, cierre del header y apertura del body
        do // llenar tabla con el contenido de la query
        {
            $i = 0;
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                if($i == 0) // pillamos la primary para lanzar el modify sobre eso
                {
                    $dni = $value;
                    $table .= "<td>$value</td>";
                }
                else if($i == 8 || $i == 9) // calificacion_teoria o practica
                {
                    switch($value)
                    {
                        case 0: $table .= "<td>Sense qualificar</td>"; break;
                        case 1: $table .= "<td>Pendent de qualificar</td>"; break;
                        case 2: $table .= "<td>Aprovat</td>"; break;
                        case 3: $table .= "<td>Suspes</td>"; break;
                        default: errorCreateTable();
                    }
                }
                else if($i == 11) // data convocatoria
                {
                    if($value == "0000-00-00")
                        $table .= "<td>Sense especificar</td>";
                    else
                        $table .= "<td>$value</td>";
                }
                else if($i == 12) // estado memoria
                {
                    switch($value)
                    {
                        case 0: $table .= "<td>No entregada</td>"; break;
                        case 1: $table .= "<td>Entregada</td>"; break;
                        default: errorCreateTable();
                    }
                }
                else if($i == 13) // aprobado
                {
                    switch($value)
                    {
                        case 0: $table .= "<td>Pendent</td>"; break;
                        case 1: $table .= "<td>No apte</td>"; break;
                        case 2: $table .= "<td>Apte</td>"; break;
                        default: errorCreateTable();
                    }
                }
                else if($i == 14) // numero titulo
                {
                    if($value)
                        $table .= "<td>$value</td>";
                    else
                        $table .= "<td>Sense títol</td>";
                }
                else
                    $table .= "<td>$value</td>";
                $i++;
            }
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='dni' value='$dni'><input type='submit' class='btn btn-info btn-sm' name='personal' value='MODIFICAR'></form></td>";
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='dni' value='$dni'><input type='submit' class='btn btn-info btn-sm' name='expedient' value='MODIFICAR'></form></td>";// botón de modificar
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='dni' value='$dni'><input type='submit' class='btn btn-info btn-sm' name='deutes' value='MODIFICAR'></form></td>";
            $table .= "</tr>";
        } while ($row = mysqli_fetch_assoc($res));
        $table .= "</tbody></table>";
        echo $table;
    }
    else
        errorNoResults();
}

?>