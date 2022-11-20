/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

async function cargarPregunta() {
    let respuesta = await fetch('/PHP/API_get.php' + '?funcion=getCategorias') // con '?' separamos la ruta de los parametros
                        /*El await espera al resultado de la promesa que devuelve la funcion asincrona*/
   
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

function cargarCategoria(datosCategoria) {
    let selectCategoria = document.getElementById("categoria");
    var nuevaOption = document.createElement("option");
    nuevaOption.text = datosCategoria.nombre;
    nuevaOption.value = datosCategoria.id_cat;
    selectCategoria.appendChild(nuevaOption);
}

cargarPregunta()
    .then( function(resultadoPromesa) {
        if (resultadoPromesa.mensaje) { // != undefined
            console.error(resultadoPromesa);
        } else {
            resultadoPromesa.forEach(datosCategoria => {
                cargarCategoria(datosCategoria);
            });
        }
    }
);