/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 */


//Variables Globales:
let buscar = document.getElementById("buscar");
let categoria = document.getElementById("categoria");
let orden = document.getElementById("order");

//Con el objeto  window.location obtenemos la dirección de la página actual (URL) y redirigimos el navegador a una nueva página.
//queryString es la parte de una URL donde los datos se pasan a una aplicación web y/o base de datos de back-end
//URLSearchParams es la interfaz que define métodos de utilidad para trabajar con la cadena de consulta de una URL.

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

//Funcion para cargar la busqueda:
function cargarBusqueda() {
    //El método .has  devuelve un valor booleano que indica si existe un parámetro con el nombre especificado. 
    //El método .get devolverá el primer valor asociado con el parámetro de búsqueda dado.
    if(urlParams.has('buscar')) {  
        buscar.value = urlParams.get('buscar');
    }

    if(urlParams.has('categoria')) {    
        categoria.value = urlParams.get('categoria');
    }

    if(urlParams.has('order')) {
        orden.value = urlParams.get('order');
    }

}
//Ejecuta la funcion.
cargarBusqueda();