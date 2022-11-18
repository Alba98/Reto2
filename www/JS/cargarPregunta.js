/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Vamos a guardar la URL (no es la ruta de los archivos , si no del HTTP)
const API_URL = '/PHP/API_get.php';

async function cargarPregunta() {
    let respuesta = await fetch(API_URL + '?funcion=getDetallesPregunta&id=1') // con '?' separamos la ruta de los parametros
                        /*El await espera al resultado de la promesa que devuelve la funcion asincrona*/
   
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

function cargarLayout(datosPregunta) {
    let contenedorPregunta = document.getElementsByClassName("zonaPregunta")[0];
    let pregunta = document.createElement('div');
    pregunta.classList.add('pregunta');

    pregunta.innerHTML = `
        <div class='detalles'>
            <div class='votacion'>
                <a class='like' href='#1'><i class='fa-solid fa-sort-up'></i></a>
                <b id='votos' class='votos'>${datosPregunta.likes} LIKE</b>
                <a class='like' href='#2'><i class='fa-solid fa-sort-down'></i></a>
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
                <div class='descripcion'>
                    ${datosPregunta.detalle}
                </div>
            </div>
        </div>`;

    contenedorPregunta.appendChild(pregunta);
}

cargarPregunta()
    .then( function(resultadoPromesa) {
        if (resultadoPromesa.mensaje) { // != undefined
            console.error(resultadoPromesa);
        } else {
            resultadoPromesa.forEach(datosPregunta => {
                cargarLayout(datosPregunta);
            });
        }
});
 









 

