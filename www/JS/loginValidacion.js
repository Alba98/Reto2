/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Elementos
var botonRegitro = document.getElementById("btn-registrar");
var iNombre = document.getElementById("rnombre");
var iEmail = document.getElementById("remail");
var iPassword = document.getElementById("rPassword");

// Texto incorrecto
var nombreIncorrecto = document.getElementById("nombreIncorrecto");
var emailIncorrecto = document.getElementById("emailIncorrecto");
var passwordIncorrecto = document.getElementById("passIncorrecta");

//Eventos
botonRegitro.addEventListener("click", validarFormulario);

function validarFormulario() {
   try {
        validarNombre();
        validarEmail();
        validarPassword();

        var form = document.getElementById('registroForm');
        if(form) form.submit();
    } catch (error) {
        console.log(error);
    }
}
//Funcion para validar la constraseña:
function validarPassword() {
    //Datos de entrada:
    let pass = iPassword.value;
    //Expresiones regulares:
    let exRegPass = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    
    /* Explicación de la expresión regular de la contraseña:
        ->(?=.*[az]) 	    La cadena debe contener al menos 1 carácter alfabético en minúscula.
        ->(?=.*[AZ]) 	    La cadena debe contener al menos 1 carácter alfabético en mayúscula.
        ->(?=.*[0-9]) 	    La cadena debe contener al menos 1 carácter numérico.
        ->(?=.*[!@#$%^&*]) 	La cadena debe contener al menos un carácter especial, pero estamos escapando de los caracteres RegEx reservados para evitar conflictos.
        ->(?=.{8,}) 	    La cadena debe tener ocho caracteres o más. */

    if (exRegPass.test(pass)){
        passwordIncorrecto.hidden = true;
    } else {
        iPassword.focus();
        passwordIncorrecto.hidden = false;
        throw "Problemas contraseña";
    }
}
//Funcion para validar el nombre:
function validarNombre() {
    if(iNombre.value) {
        nombreIncorrecto.hidden = true;
    } else {
        iNombre.focus();
        nombreIncorrecto.hidden = false;
        throw "Nombre vacio";
    }
}
//Funcion para validar el email:
function validarEmail() {
    if(iEmail.value) {
        emailIncorrecto.hidden = true;
    } else {
        iEmail.focus();
        emailIncorrecto.hidden = false;
        throw "Email vacio";
    }
}

// Boton del ojo, mostraremos el campo de la contraseña
function mostrarContrasenaLogin(){
    var tipo = document.getElementById("pass");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

function mostrarContrasenaRegistro(){
    var tipo = document.getElementById("rPassword");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}