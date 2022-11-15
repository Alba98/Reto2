/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Eventos
document.getElementById("editar").addEventListener("click",edit);
document.getElementById("contraseniaBtn").addEventListener("click", mostrarMenu);
document.getElementById("contra2").addEventListener("focusout", matchPassword);
document.getElementById("nombre").addEventListener("focusout", validarNombre);
document.getElementById("apellidos").addEventListener("focusout", validarApellidos);
document.getElementById("email").addEventListener("focusout", validarEmail);
//document.getElementById("guardarPerfil").addEventListener("click", validarFormulario);

function edit() {
    let inputs = document.getElementsByClassName("inputs");
    for (let x = 0; x < inputs.length; x++) {
        inputs[x].disabled = false;
    }
}

function mostrarMenu(){
    let menu = document.getElementById("cambiarPASS");
    menu.classList.toggle("shown");
}

function matchPassword(){
    let pass1 = document.getElementById("contra1").value;
    let pass2 = document.getElementById("contra2").value;
    if(pass1 != pass2){	
        document.getElementById("passIncorrecta").hidden = false;
    } else {
        document.getElementById("passIncorrecta").hidden = true;
    }
}

function validarNombre() {
    let nom = document.getElementById('nombre').value;
    let exRegName  =  new RegExp (/^[A-Z]{1}[a-z]+$/);
    if (!exRegName.test(nom)){
        document.getElementById("nombre").focus();
        document.getElementById("nombreIncorrecto").hidden = false;
    } else {
        document.getElementById("nombreIncorrecto").hidden = true;
    }
}

function validarApellidos() {
    let apellido = document.getElementById('apellidos').value;
    let exRegName  =  new RegExp (/^[A-Z]{1}[a-z]+$/);
    if (!exRegName.test(apellido)){
        document.getElementById("apellidos").focus();
        document.getElementById("apellidosIncorrectos").hidden = false;
    } else {
        document.getElementById("apellidosIncorrectos").hidden = true;
    }
}

function validarEmail() {
    let email = document.getElementById('email').value;
    let exRegEmail =  new RegExp ('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$');
    if (!exRegEmail.test(email)){
        document.getElementById("email").focus();
        document.getElementById("emailIncorrecto").hidden = false;
    } else {
        document.getElementById("emailIncorrecto").hidden = true;
    }
}



    



