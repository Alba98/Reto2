/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Eventos
document.getElementById("editar").addEventListener("click",edit);
document.getElementById("contraseniaBtn").addEventListener("click", mostrarMenu);
document.getElementById("guardarPerfil").addEventListener("click", validarFormulario);

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
        alert("Las contraseñas no coinciden");
    } else {
        alert("Cambio de contraseña realizado correctamente");
    }
}

function validarFormulario(evento){

  evento.preventDefault();   //Funcion para prevenir la accion por defecto del evento

    try {
        //Datos de entrada:
        let nom = document.getElementById('nombre').value;
        let apellido = document.getElementById('apellidos').value;
        let email = document.getElementById('email').value;
   
        //Expresiones regulares:
        let exRegName  =  new RegExp (/^[A-Z]{1}[a-z]+$/);
        let exRegEmail =  new RegExp ('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$');
        let exRegPass  =  new RegExp ("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        //Validaciones:
        
        if (!exRegName.test(nom)){
            document.getElementById("nombre").focus();
            throw "Nombre incorrecto";
        }

        if (!exRegName.test(apellido)){
            document.getElementById("apellidos").focus();
            throw "Apellidos incorrectos";
        }
        
        if (!exRegEmail.test(email)){
            document.getElementById("email").focus();
            throw "Email incorrecto";
        }
        matchPassword();
        
        let objeto={nom:nom, 
                    apellido:apellido,
                    email:email};

        alert("Tu nombre es: "      + objeto.nom
             + "\n Tu apellido es:" + objeto.apellido
             + "\n Tu correo es: "  + objeto.email);
              
        
    }catch (error) {
             alert('Error salta el catch: ' + error);
        return;
    }
    
}





    



