/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Eventos:
document.getElementById("btn-registrar").disabled = true;
document.getElementById("loginPassword").addEventListener("focusout", validarFormulario);

function validarFormulario(evento) {
    //Funcion para prevenir la accion por defecto del evento
    evento.preventDefault(); 
    try {
        //Datos de entrada:
        let pass = document.getElementById('loginPassword').value;
        //Expresiones regulares:
        let exRegPass = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        
        /* Explicación de la expresión regular de la contraseña:
            ->(?=.*[az]) 	    La cadena debe contener al menos 1 carácter alfabético en minúscula.
            ->(?=.*[AZ]) 	    La cadena debe contener al menos 1 carácter alfabético en mayúscula.
            ->(?=.*[0-9]) 	    La cadena debe contener al menos 1 carácter numérico.
            ->(?=.*[!@#$%^&*]) 	La cadena debe contener al menos un carácter especial, pero estamos escapando de los caracteres RegEx reservados para evitar conflictos.
            ->(?=.{8,}) 	    La cadena debe tener ocho caracteres o más. */

        if (!exRegPass.test(pass)){
            document.getElementById("passIncorrecta").hidden = false;
        } else {
            document.getElementById("passIncorrecta").hidden = true;
            document.getElementById("btn-registrar").disabled = false;
        }
      } catch (error) {
                 alert('Error: ' + error);
        return;
    }
}