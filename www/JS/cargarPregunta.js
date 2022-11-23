/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/



//Vamos a guardar la URL (no es la ruta de los archivos , si no del HTTP)
const API_URL = '/PHP/API_get.php';

// Con la siguiente funcion cargamos cada layout de los detalles de las preguntas con su correspondiente id de la BBDD      
 //El await espera al resultado de la promesa que devuelve la funcion asincrona              
async function cargarPregunta(id_preg) {
    let respuesta = await fetch(API_URL + '?funcion=getDetallesPregunta&id='+id_preg)// con '?' separamos la ruta de los parametros    
    if (respuesta.ok) {
        return respuesta.json(); //Si la respuesta es correcta convertimos a datos JSON.
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

/***************************************************************************
Usamos la interfaz DOM poque representa cómo el navegador lee documentos HTML. 
Permite que el lenguaje JavaScript manipule, estructure y diseñe su sitio web. 
***************************************************************************/

//Funcion cargar vista de los detalles de la pregunta:
function cargarLayout(datosPregunta) {
    let contenedorPregunta = document.getElementsByClassName("zonaPregunta")[0];
    let pregunta = document.createElement('div');
    pregunta.classList.add('detalles');
    pregunta.classList.add('recuadro');

    pregunta.innerHTML = `
            <div class='votacion'>
                <a class='like' onclick=\"insertarLike('${datosPregunta.id_preg}')\"><i class='fa-solid fa-sort-up'></i></a>
                <b id='likes' class='votos'>${datosPregunta.likes} LIKE</b>
                <a class='like'onclick=\"borrarLike('${datosPregunta.id_preg}')\"><i class='fa-solid fa-sort-down'></i></a>
            </div>
            <div class='user'>
                <h3 class='titulousuario' id='titulousuario'>${datosPregunta.usuario}</h3>
                <img class='perfil' src='../RECURSOS/IMAGES/user.png' alt='Foto de pergil'>
                <form>
                    <p class='clasificacion'>
                    <input id='radio1' type='radio' name='estrellas' value='1'>
                    <label for='radio1'>★</label>
                    <input id='radio2' type='radio' name='estrellas' value='2'>
                    <label for='radio2'>★</label>
                    <input id='radio3' type='radio' name='estrellas' value='3'>
                    <label for='radio3'>★</label>
                    <input id='radio4' type='radio' name='estrellas' value='4'>
                    <label for='radio4'>★</label>
                    <input id='radio5' type='radio' name='estrellas' value='5'>
                    <label for='radio5'>★</label>
                    </p>
                </form>
            </div>
            <div class='info'>
                <h1>${datosPregunta.titulo}</h1>
                <p><b>Usuario:</b> ${datosPregunta.usuario}</p>
                <p><b>Fecha de publicación:</b> ${datosPregunta.fecha}</p>
                <p><b>Departamento:</b> ${datosPregunta.categoria}</p>
                <div class='descripcion recuadro'>
                    ${datosPregunta.detalle}
                </div>
            </div>`;

    contenedorPregunta.appendChild(pregunta);

    //Añadimos el id  de la pregunta al formulario de respuesta:
    let contenedorResponder = document.getElementsByClassName("izq")[0];
     var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "pregId");
    input.setAttribute("id", "pregId");
    input.setAttribute("value", datosPregunta.id_preg);

    contenedorResponder.appendChild(input);
}

//Usamos el almacenacimiento local 'localStorage' porque los datos almacenados en el navegador persistirán incluso después de que se cierre la ventana del navegador:
//El método getItem() de la interfaz localStorage devuelve el valor de la clave cuyo nombre se le pasa por parámetro:
let id_preg = localStorage.getItem('idPregunta');
cargarPregunta(id_preg)
//La respuesta del servidor la recibimos como parámetro en la función que indicamos para ejecutar en el caso positivo, then():
    .then( function(resultadoPromesa) {
        if (resultadoPromesa.mensaje) { // != undefined
            console.error(resultadoPromesa);
        } else {
            cargarLayout(resultadoPromesa[0]);
        }
    }
);
 
async function insertarLike(id_preg) {
    let respuesta = await fetch('/PHP/API_get.php' + '?funcion=insertarLike&id='+id_preg)
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

async function borrarLike(id_preg) {
    let respuesta = await fetch('/PHP/API_get.php' + '?funcion=borrarLike&id='+id_preg)
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}








 

