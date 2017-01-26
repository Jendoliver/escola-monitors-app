<?php
/*
*
* print_lib.php: Librería gráfica de la aplicación
*
*/

function printBackButton()
{
    $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
    echo "<form><input type='submit' formaction='$url' value='Torna enrere'></form>"; 
}

function printHomeButton()
{
    echo "<form><input type='submit' formaction='../front_end/homepage.php' value='Torna a la pagina principal'></form>";
}

function mostrarCodigo($codigo) // PROCEDIMIENTO QUE MUESTRA EL CÓDIGO DE CURSO RECIÉN CREADO
{
    $message = "El codi del curs creat és: $codigo";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '../front_end/homepage.php';
    </script>";
}

function alumnoInsertado() // PROCEDIMIENTO QUE CONFIRMA QUE UN ALUMNO HA SIDO INSERTADO CON ÉXITO
{
    $message = "Alumne insertat amb èxit. En vols afegir un altre?";
    echo "<script type='text/javascript'>
    var confirmar=confirm('$message'); 
    if(confirmar)
    window.location = '../front_end/alta_alumno.php';
    else
    window.location = '../front_end/homepage.php';
    </script>";
}

function updateCorrect()
{
    $message = "Actualització exitosa";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '../front_end/homepage.php';
    </script>";
}