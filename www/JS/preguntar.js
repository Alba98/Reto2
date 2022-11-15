/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

var botonPreguntar = document.getElementById("preguntar");
var iTitulo = document.getElementById("titulo");
var iCategoria = document.getElementById("categoria");
var iDetalle = document.getElementById("detalle");
var iArchivo = document.getElementById("archivo");

// Texto incorrecto
var tituloIncorrecto = document.getElementById("tituloIncorrecto");
var categoriaIncorrecto = document.getElementById("categoriaIncorrecto");
var detalleIncorrecto = document.getElementById("detalleIncorrecto");

//Eventos
botonPreguntar.addEventListener("click", validar);
iTitulo.addEventListener("focusout", validarTitulo);
iCategoria.addEventListener("focusout", validarCategoria);
iDetalle.addEventListener("focusout", validarDetalle);


function validar() {
    validarTitulo();
    validarCategoria();
    validarDetalle();
    // validarArchivo();
}

function validarTitulo() {
    if(iTitulo.value) {
        tituloIncorrecto.hidden = true;
    } else {
        iCategoria.focus();
        tituloIncorrecto.hidden = false;
    }
}

function validarCategoria() {
    if(iCategoria.value != '0') {
        categoriaIncorrecto.hidden = true;
    } else {
        iCategoria.focus();
        categoriaIncorrecto.hidden = false;
    }
}

function validarDetalle() {
    if(iDetalle.value) {
        detalleIncorrecto.hidden = true;
    } else {
        iCategoria.focus();
        detalleIncorrecto.hidden = false;
    }
}