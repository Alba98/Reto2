/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Eventos:
document.getElementById("btn-login").addEventListener("click", validarFormulario);

function validarFormulario(evento) {
    //Funcion para prevenir la accion por defecto del evento
    evento.preventDefault(); 
    try {
        //Datos de entrada:
        let email = document.getElementById('loginEmail').value;
        let pass = document.getElementById('loginPassword').value;
        //Expresiones regulares:
        let exRegEmail = new RegExp('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$');
        let exRegPass   = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
           //Explicación de la expresión regular de la contraseña:
        /* 
            ->(?=.*[az]) 	    La cadena debe contener al menos 1 carácter alfabético en minúscula.
            ->(?=.*[AZ]) 	    La cadena debe contener al menos 1 carácter alfabético en mayúscula.
            ->(?=.*[0-9]) 	    La cadena debe contener al menos 1 carácter numérico.
            ->(?=.*[!@#$%^&*]) 	La cadena debe contener al menos un carácter especial, pero estamos escapando de los caracteres RegEx reservados para evitar conflictos.
            ->(?=.{8,}) 	    La cadena debe tener ocho caracteres o más. 
        */
        
        if (!exRegEmail.test(email)){
                document.getElementById("loginEmail").focus();
                     throw "Email incorrecto";
        }

        if (!exRegPass.test(pass)){
            document.getElementById("loginEmail").focus();
                 throw "Contraseña incorrecto";
        }

        let objeto={email:email}; 
        alert("Tu email es: " + objeto.email);
      } catch (error) {
                 alert('Error: ' + error);
        return;
    }
       
     

     

        

    
        
    }



    

  