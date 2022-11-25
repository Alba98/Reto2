/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/


//Esperamos a que cargue la pregunta después de haber seleccionado la categoria:
async function cargarPregunta() {
    let respuesta = await fetch('/PHP/API_get.php' + '?funcion=getCategorias');
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

//Cargamos la categoria seleccionada desde el menú de opciones:
function cargarCategoria(datosCategoria) {
    let selectCategoria = document.getElementById("categoria");
    var nuevaOption = document.createElement("option");
        nuevaOption.text = datosCategoria.nombre;
        nuevaOption.value = datosCategoria.id_cat;
    selectCategoria.appendChild(nuevaOption);
}


cargarPregunta()
    .then( function(resultadoPromesa) {
        if (resultadoPromesa.mensaje){ // != undefined
            console.error(resultadoPromesa);
        }else {
            resultadoPromesa.forEach(datosCategoria => {
                cargarCategoria(datosCategoria);
            });
        if (typeof cargarBusqueda === 'function') //unction is defined
                cargarBusqueda();
        }
    }
);