/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

var botonResponder = document.getElementById("responder");
var iDetalle = document.getElementById("detalleR");

// Texto incorrecto
var detalleIncorrecto = document.getElementById("detalleIncorrecto");

//Eventos
botonResponder.addEventListener("click", validar);
iDetalle.addEventListener("focusout", validarDetalle);

function validar() {
    try {
        validarDetalle();
        // validarArchivo();
        
        enviarRespuesta().then( function(resultadoPromesa) {
            if (resultadoPromesa.mensaje) { 
                console.error(resultadoPromesa);
            } else {
                console.log(resultadoPromesa);
            }
        });
    } catch (error) {
        console.log(error.mensaje);
    }
}

function validarDetalle() {
    console.log("validarDetalle")
    if(iDetalle.value) {
        detalleIncorrecto.hidden = true;
    } else {
        iDetalle.focus();
        detalleIncorrecto.hidden = false;
    }
}

async function enviarRespuesta() {
    let respuesta = await fetch('/PHP/API_get.php' 
                                + '?funcion=enviarRespuesta'
                                + '&detalle='+iDetalle.value);
    
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}