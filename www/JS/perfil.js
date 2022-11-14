/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Eventos
document.getElementById("guardar").addEventListener("guardarPerfil", validarFormulario);
document.getElementById("editar").addEventListener("click",edit);
document.getElementById("contraseniaBtn").addEventListener("click", mostrarMenu);


//Funciones globales
function edit() {
    let inputs = document.getElementsByClassName("inputs");
    for (let x = 0; x < inputs.length; x++) {
        inputs[x].disabled = false;
    }
}
function mostrarMenu(){//Funcion para mostrar el menu de resetear la contraseña
    let menu = document.getElementById("cambiarPASS");
    menu.classList.toggle("shown");
}
function matchPassword(){

    let pass1 = document.getElementById("contra1");
    let pass2 = document.getElementById("contra2");
   
    if(pass1 != pass2){	
  	    alert("Las contraseñas no coinciden");
  } else {
  	alert("Cambio de contraseña realizado correctamente");
  }
}



function validarFormulario(){

    try {
        //Datos de entrada:
        let nom = document.getElementById('nombre').value;
        let apellido = document.getElementById('apellidos').value;       
        let pass = document.getElementById('contraseniaBtn').value;
        let email = document.getElementById('loginEmail').value;
        //Expresiones regulares:
        let exRegEmail = new RegExp('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$');
        let exRegPass   = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
             
        if (!exRegEmail.test(email)){
            document.getElementById("loginEmail").focus();
            throw "Email incorrecto";
        }
       
        if (!exRegPass.test(pass)){
            document.getElementById("loginEmail").focus();
            throw "Contraseña incorrecto";
        }
        
        matchPassword();
       
        let objeto={nom:nom, 
                    apellido:apellido,
                    email:email};

        alert("Tu nombre es: " + objeto.nom
             + "\n Tu apellido es: "+ objeto.apellido
             + "\n Tu correo es: "  + objeto.email);
              
        
    } catch (error) {
        alert('Error: ' + error);
        return;
    }
    
}









    



