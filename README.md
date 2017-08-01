FORMULARIO POST JSON Y AJAX
=====================

## Descripción

<p align="justify">
    El siguiente formulario recolecta los datos encapsulandonos en un objeto de <i>Javascript</i> con formato <i>JSON</i> enviando los a través de <i>JQuery AJAX</i> con el metodo <i>POST</i> a un <i>SCRIPT</i> en <i>PHP</i> que responde al objeto <i>AJAX</i>.
</p>
    
## Desarrollo

1. Tomamos nuestro <a href="https://github.com/ginppian/Boostrap-Formulario-Resposivo">Formulario Pasado</a>.
2. Y en la código de <i>JS/JQuery</i> implementamos

````
$(document).ready(function(){


});

$(document).on("click", "#button", function(){

    if(isFullForm()){
        if(isEmail(getCorreo())){
            if(verifyEqualPass(getPassword(), getVerifyPassword())){

                var myObj = JSON.stringify(getFormInJSON());

                $.ajax({
                    type:"POST",
                    url:"signup.php",
                    contentType: 'application/x-www-form-urlencoded',
                    data:{obj:myObj},
                    success: function(result){

                        alert(result);
                    },
                    error: function(e){
                        console.log(e.message);
                    }
                });


            }else{
                alert("¡Las contraseñas NO coinciden!");
            }
        } else {
            alert("¡Por favor ingresa un correo VALIDO!");
        }
    } else {
        alert("Por favor llena todos los campos");
    }
});

function getNombre() {
    return $("#nombre").val();
}

function getPaterno() {
    return $("#paterno").val();
}

function getMaterno() {
    return $("#materno").val();
}

function getCorreo() {
    return $("#correo").val();
}

function getPassword() {
    return $("#password").val();
}

function getVerifyPassword() {
    return $("#verifyPassword").val();
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isFullForm(){
    if( getNombre()   != ''       && getNombre()   != ' ' &&
        getPaterno()  != ''       && getPaterno()  != ' ' &&
        getMaterno()  != ''       && getMaterno()  != ' ' &&
        getCorreo()   != ''       && getCorreo()   != ' ' &&
        getPassword() != ''       && getPassword() != ' ' &&
        getVerifyPassword() != '' && getVerifyPassword() != ' '
    ){
        return true;
    } else {
        return false;
    }
}

function verifyEqualPass(pass1, pass2){
    if(pass1 == pass2){
        return true;
    } else {
        return false;
    }
}

function getFormInJSON(){

    var obj = {}
    obj["nombre"]   = getNombre();
    obj["paterno"]  = getPaterno();
    obj["materno"]  = getMaterno();
    obj["correo"]   = getCorreo();
    obj["password"] = getPassword();

    return obj;
}

````
 
3 . Y En el <i>Backend</i> copiamos lo siguiente

````
<?php

header('Content-type: application/x-www-form-urlencoded');
$obj = json_decode($_POST["obj"]);
echo $obj->nombre;
````

## Explicación

1. Validamos que los datos ingresados por el usuario esten correnctos.

2. Formamos un Objeto de tipo <i>CLAVE:VALOR</i> y lo pasamos a cadena.

3. Cabe aclarar que dentro de *AJAX* en el parametro *contentType* podemos eliminarlo o especificar que el tipo que sería *'application/x-www-form-urlencoded'* puesto que se envia los datos de un formulario a través del método *POST* si nos otros pusieramos *'Application/JSON'* nuestro *Script* en PHP no podría obtener los datos a través de *POST* sino que tendríamos que usar otros métodos pero no *POST*.

4. En el *Backend* nos otros ponemos la cabecera *'Content-type: application/x-www-form-urlencoded'* como buena práctica. A continuación obtenemos el objeto que se encuentra dentro del *Array de POST* y ese objeto podemos acceder a sus parametros.


## Fuente

* <a href="https://stackoverflow.com/questions/2507030/email-validation-using-jquery">Email Validation JQuery</a>

* <a href="https://stackoverflow.com/questions/20295080/ajax-call-with-contenttype-application-json-not-working">Ajax call with contentType: 'application/json' not working</a>
