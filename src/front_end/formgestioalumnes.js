function nom()
{
    document.getElementById("datainput").innerHTML = "<input type='text' class='form-control' name='nom' value='' placeholder='Nom'> <input type='text' class='form-control' name='cog1' value='' placeholder='Primer cognom'> <input type='text' class='form-control' name='cog2' value='' placeholder='Segon cognom'>";
}

function email()
{
    document.getElementById("datainput").innerHTML = "<input type='text' class='form-control' name='data' placeholder='Email' required>";
}

function dni()
{
    document.getElementById("datainput").innerHTML = "<input type='text' class='form-control' name='data' minlength=9 maxlength=9 placeholder='DNI' required>";
}

function tel()
{
    document.getElementById("datainput").innerHTML = "<input type='text' class='form-control' name='data' minlength=9 placeholder='Telèfon' required>";
}