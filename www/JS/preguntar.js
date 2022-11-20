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
    try {
        validarTitulo();
        validarCategoria();
        validarDetalle();
        // validarArchivo();
        
        enviarPregunta().then( function(resultadoPromesa) {
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

function validarTitulo() {
    if(iTitulo.value) {
        tituloIncorrecto.hidden = true;
    } else {
        iTitulo.focus();
        tituloIncorrecto.hidden = false;
        throw new Error("Titulo");
    }
}

function validarCategoria() {
    if(iCategoria.value != '0') {
        categoriaIncorrecto.hidden = true;
    } else {
        iCategoria.focus();
        categoriaIncorrecto.hidden = false;
        throw new Error("Categoria");
    }
}

function validarDetalle() {
    if(iDetalle.value) {
        detalleIncorrecto.hidden = true;
    } else {
        iDetalle.focus();
        detalleIncorrecto.hidden = false;
        throw new Error("Detalle");
    }
}

async function enviarPregunta() {
    let respuesta = await fetch('/PHP/API_get.php' 
                                + '?funcion=enviarPregunta'
                                + '&titulo='+iTitulo.value
                                + '&categoria='+iCategoria.value
                                + '&detalle='+iDetalle.value);
    
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}