/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

var botonPreguntar = document.getElementById("responder");
var iDetalle = document.getElementById("detalleR");

// Texto incorrecto
var detalleIncorrecto = document.getElementById("detalleIncorrecto");

//Eventos
botonPreguntar.addEventListener("click", validar);
iDetalle.addEventListener("focusout", validarDetalle);

function validar() {
    validarDetalle();
    // validarArchivo();
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