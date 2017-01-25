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
function insertarCurso($tipo, $mod, $precio, $ano) // FUNCIÓN QUE INSERTA UN CURSO EN LA TABLA CURSO, DEVUELVE CÓDIGO DE CURSO (PRIMARY KEY) Ó 0 EN CASO DE ERROR
{
    $code = createCode();
    $conexion = conectar("edm");
    $insert = "INSERT INTO Curso VALUES($code, $tipo, '$mod', $precio, $ano);";
    if(mysqli_query($conexion, $insert))
    {
        echo "Curso dado de alta";
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
            echo "Alumno dado de alta";
            desconectar($conexion);
            return 1;
        }
        else
        {
            echo mysqli_error($conexion);
            desconectar($conexion);
            return 0;
        }
    }
    else
    {
        echo mysqli_error($conexion);
        desconectar($conexion);
        return 0;
    }
}

//SELECTS
function createCode() // FUNCIÓN QUE DEVUELVE UN CÓDIGO DE CURSO NUEVO
{
    $con = conectar("edm");
    $query = "SELECT id_curso FROM Curso"; // pillamos todos los codigos
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
function mostrarCodigo($codigo) // PROCEDIMIENTO QUE MUESTRA EL CÓDIGO DE CURSO RECIÉN CREADO
{
    // POPUP JS :(
    echo "El codi del curs creat es $codigo";
    printBackButton();
}

function alumnoInsertado() // PROCEDIMIENTO QUE CONFIRMA QUE UN ALUMNO HA SIDO INSERTADO CON ÉXITO
{
    // POPUP JS PLIXXXXX
}

//SELECTS
function showCursoByCode($code) // PROCEDIMIENTO QUE MUESTRA UN SOLO CURSO CON id_curso = $code Y OPCIONES DE GESTIÓN (mostrar alumnos del curso, modificar curso //NUNCA EL CÓDIGO//)
{
    $con = conectar("edm");
    if($res = mysqli_query($con, "SELECT * FROM Curso WHERE id_curso = $code"))
    {
        createTable($con, $res);
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

function showAlumnoByNom($nom) // TODO
{
   /* $con = conectar("edm");
    if($res = mysqli_query($con, "SELECT * FROM Alumno WHERE nombre")) // HAY Q HACER ALGO CON LOS ESPACIOS
    */
}

function showAlumnoByEmail($email)
{
    $con = conectar("edm");
    if($res = mysqli_query($con, "SELECT * FROM Alumno WHERE email = '$email'"))
    {
        echo "";
    }
}

function createTable($con, $res) // $con = conexion bbdd, $res = resultado query
{
    $row = mysqli_fetch_assoc($res);
    echo "<table border=2px><th>";
    foreach($row as $key => $value) // header tabla
    {
        echo "<td>$key</td>";
    }
    echo "<td>Modificar</td></th>"; // columna de botón modificar

    do // llenar tabla con el contenido de la query
    {
        echo "<tr>"; // principio de fila
        foreach($row as $key => $value) // llenamos una fila
        {
            if($key == "id_curso" or $key == "dni") // pillamos la primary para lanzar el modify sobre eso
            {    
                $type = $key;
                session_start();
                $_SESSION["primary"] = $value;
            }
            echo "<td>$value</td>";
        }
        echo "<input type='submit' name='$type' formaction='../front_end/modificardatos.php' value='MODIFICAR'>"; // botón de modificar
    } while ($row = mysqli_fetch_assoc($res));
    echo "</table>";
}

?>