<?php
/*
*
* bbdd_lib.php: LIBRERÍA DE FUNCIONES Y PROCEDIMIENTOS CORRESPONDIENTES A LAS CONSULTAS A LA BASE DE DATOS
*   Autor: Jhen D'Òliver et a ver si un Magners se lo firma pero si me hace algun JS dile ahi pohohohoho
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
    $insert = "INSERT INTO Curso(`id_curso`, `tipo_curso`, `modalidad`, `fecha_ini`, `fecha_fin`, `lugar`, `precio`) VALUES($code, $tipo, '$mod', '$fecha_ini', '$fecha_fin', '$lugar', $precio);";
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
            return 0;
        }
    }
    else
    {
        desconectar($conexion);
        return 0;
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
    $update = "UPDATE Curso SET tipo_curso = $tipo, modalidad = '$mod', fecha_ini = '$fecha_ini', fecha_fin = '$fecha_fin', lugar = '$lugar', precio = $precio WHERE id_curso = $code;";
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
    $update = "UPDATE Alumno SET nombre = '$nom', ape1 = '$cog1', ape2 = '$cog2', fecha_nacimiento = '$dnaix', direccion = '$dir', telefono = '$tel', email = '$email' WHERE dni = $dni;";
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

function updateAlumnoExpedient($dni, $teorica, $practica, $convocatoria, $memoria, $aprovat)
{
    $con = conectar("edm");
    $update = "UPDATE Alumno SET calificacion_teoria = $teorica, calificacion_practicas = $practica, fecha_memoria = '$convocatoria', memoria = $memoria, aprobado = $aprovat WHERE dni = '$dni';";
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


/********PROCEDIMIENTOS*********/
//SELECTS
function showCursoByCode($code) // PROCEDIMIENTO QUE MUESTRA UN SOLO CURSO CON id_curso = $code Y OPCIONES DE GESTIÓN (mostrar alumnos del curso, modificar curso //NUNCA EL CÓDIGO//)
{
    $con = conectar("edm");
    if($res = mysqli_query($con, "SELECT * FROM Curso WHERE id_curso = $code;"))
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

function showCursos($tipo, $mod, $ano) // PROCEDIMIENTO QUE MUESTRA UNO O VARIOS CURSOS SEGÚN EL TIPO, MODALIDAD Y AÑO ESPECIFICADO
{
    
}

function showAlumnoByNom($nom, $cog1, $cog2) // TODO
{
    $con = conectar("edm");
    $select = "SELECT * FROM Alumno WHERE nombre = '$nom' and ape1 = '$cog1' and ape2 = '$cog2';";
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
    $select = "SELECT * FROM Alumno WHERE email = '$email';";
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
    $select = "SELECT * FROM Alumno WHERE dni = '$dni';";
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
    $select = "SELECT * FROM Alumno WHERE telefono = '$tel';";
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
    $select = "SELECT * FROM Alumno INNER JOIN Inscrito ON Alumno.dni = Inscrito.dni WHERE Inscrito.id_curso = $code";
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

function showMorosos()
{
    $con = conectar("edm");
    $select = "SELECT * FROM Alumno WHERE dinero_debido != 0;";
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
    $select = "SELECT * FROM Alumno WHERE aprobado = 2;";
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
        $table = "<table border=2px>";
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            $table .= "<th>$key</th>";
        }
        $table .= "<th>Modificar curs</th><th>Visualitzar alumnes</th></thead><tbody>"; // columna de botón modificar, cierre del header y apertura del body
    
        do // llenar tabla con el contenido de la query
        {
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                if($key == "id_curso") // pillamos la primary para lanzar el modify sobre eso
                {    
                    $idcurso = $value;
                }
                $table .= "<td>$value</td>";
            }
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='idcurso' value='$idcurso'><input type='submit' name='curso' value='MODIFICAR'></form></td>"; // botón de modificar
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='idcurso' value='$idcurso'><input type='submit' name='alumnos' value='MOSTRAR'></form></td>";
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
        $table = "<table border=2px>";
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            $table .= "<th>$key</th>";
        }
        $table .= "<th>Modificar dades personals</th><th>Modificar expedient</th><th>Modificar deutes</th></thead><tbody>"; // columna de botón modificar, cierre del header y apertura del body
        do // llenar tabla con el contenido de la query
        {
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                if($key == "dni") // pillamos la primary para lanzar el modify sobre eso
                {
                    $dni = $value;
                }
                $table .= "<td>$value</td>";
            }
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='dni' value='$dni'><input type='submit' name='personal' value='MODIFICAR'></form></td>";
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='dni' value='$dni'><input type='submit' name='expedient' value='MODIFICAR'></form></td>";// botón de modificar
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='dni' value='$dni'><input type='submit' name='deutes' value='MODIFICAR'></form></td>";
            $table .= "</tr>";
        } while ($row = mysqli_fetch_assoc($res));
        $table .= "</tbody></table>";
        echo $table;
    }
    else
        errorNoResults();
}

?>