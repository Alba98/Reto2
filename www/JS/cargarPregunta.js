/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Vamos a guardar la URL (no es la ruta de los archivos , si no del HTTP)
const API_URL = '/PHP/API_get.php';

async function cargarPregunta(id_preg) {
    let respuesta = await fetch(API_URL + '?funcion=getDetallesPregunta&id='+id_preg) // con '?' separamos la ruta de los parametros
                        /*El await espera al resultado de la promesa que devuelve la funcion asincrona*/
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

function setValoracion(valoracion,num) {
    if (valoracion == num) {
        return "checked";
    } else return "";
}

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
                    <input id='radio1' type='radio' name='estrellas' value='5' disabled ${setValoracion(datosPregunta.valoracion,5)}>
                    <label for='radio1'>★</label>
                    <input id='radio2' type='radio' name='estrellas' value='4' disabled ${setValoracion(datosPregunta.valoracion,4)}>
                    <label for='radio2'>★</label>
                    <input id='radio3' type='radio' name='estrellas' value='3' disabled ${setValoracion(datosPregunta.valoracion,3)}>
                    <label for='radio3'>★</label>
                    <input id='radio4' type='radio' name='estrellas' value='2' disabled ${setValoracion(datosPregunta.valoracion,2)}>
                    <label for='radio4'>★</label>
                    <input id='radio5' type='radio' name='estrellas' value='1' disabled ${setValoracion(datosPregunta.valoracion,1)}>
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

    // Añadir el id pregunta al formulario de respuesta
    // <input id="pregId" name="pregId" type="hidden" value="${datosPregunta.id_preg}"></input>
    let contenedorResponder = document.getElementsByClassName("izq")[0];
    
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "pregId");
    input.setAttribute("id", "pregId");
    input.setAttribute("value", datosPregunta.id_preg);

    contenedorResponder.appendChild(input);
}

let id_preg = localStorage.getItem('idPregunta');
cargarPregunta(id_preg)
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








 

