<?php
/*
*
* print_lib.php: Librería gráfica de la aplicación
*
*/

function printBackButton()
{
    $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
    echo "<input type='submit' formaction='$url' value='Torna enrere'>"; 
}

function printHomeButton()
{
    echo "<input type='submit' formaction='homepage.php' value='Torna a la pàgina principal'>";
}