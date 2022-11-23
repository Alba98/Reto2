/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

var botonResponder = document.getElementById("responder");
var iDetalle = document.getElementById("detalleR");

// Texto incorrecto
var detalleIncorrecto = document.getElementById("detalleIncorrecto");

//Eventos
botonResponder.addEventListener("click", validarResponder);
// iDetalle.addEventListener("focusout", validarDetalle);

function validarResponder() {
    try {
        validarDetalle();
        // validarArchivo();

        enviarRespuesta().then( function(resultadoPromesa) {
            if (resultadoPromesa.mensaje) { 
                console.error(resultadoPromesa);
            } else {
                var form = document.getElementById('responderForm');
                if(form) form.submit();
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
        throw "Detalle vacio";
    }
}

async function enviarRespuesta() {
    console.log('/PHP/API_get.php' 
    + '?funcion=enviarRespuesta'
    + '&id_preg='+id_preg
    + '&detalle='+iDetalle.value);
    let respuesta = await fetch('/PHP/API_get.php' 
                                + '?funcion=enviarRespuesta'
                                + '&id_preg='+id_preg
                                + '&detalle='+iDetalle.value
                                );                    
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}