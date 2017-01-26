function nom()
{
    document.getElementById("datainput").innerHTML = "<input type='text' name='nom' placeholder='Nom' required> <input type='text' name='cog1' placeholder='Primer cognom' required> <input type='text' name='cog2' placeholder='Segon cognom'>";
}

function email()
{
    document.getElementById("datainput").innerHTML = "<input type='text' name='data' placeholder='Email' required>";
}

function dni()
{
    document.getElementById("datainput").innerHTML = "<input type='text' name='data' minlength=9 maxlength=9 placeholder='DNI' required>";
}

function tel()
{
    document.getElementById("datainput").innerHTML = "<input type='text' name='data' minlength=9 placeholder='Telèfon' required>";
}