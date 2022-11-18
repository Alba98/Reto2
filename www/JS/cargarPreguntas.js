/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Vamos a guardar la URL (no es la ruta de los archivos , si no del HTTP)
const API_URL = '/PHP/API_pregunta.php';

async function cargarPreguntas() {
    let respuesta = await fetch(API_URL + '?funcion=getPreguntas') // con '?' separamos la ruta de los parametros
                        /*El await espera al resultado de la promesa que devuelve la funcion asincrona*/
   
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

function cargarLayoutPregunta(datosPregunta) {
    let contenedorPregunta = document.getElementsByClassName("visualizacion")[0];
    let pregunta = document.createElement('div');
    pregunta.classList.add('preguntas');

    pregunta.innerHTML = `<div class='user'>
    <h2 class='titulousuario' id='titulousuario'>${datosPregunta.usuario}</h2>
    <img class='perfil' src='../RECURSOS/IMAGES/user.png' alt='Foto de perfil'>
    <form>
        <p class='clasificacion'>
            <input id='radio1' type='radio' name='estrellas' value='5'>
            <label for='radio1'>★</label>
            <input id='radio2' type='radio' name='estrellas' value='4'>
            <label for='radio2'>★</label>
            <input id='radio3' type='radio' name='estrellas' value='3'>
            <label for='radio3'>★</label>
            <input id='radio4' type='radio' name='estrellas' value='2'>
            <label for='radio4'>★</label>
            <input id='radio5' type='radio' name='estrellas' value='1'>
            <label for='radio5'>★</label>
        </p>
    </form>
</div>
<div class='info'>
    <h2>${datosPregunta.titulo}</h2>
    <p id='usuario'><b>Usuario:</b>${datosPregunta.usuario} </p>
    <p id='fecha'><b>Fecha:</b> ${datosPregunta.fecha}</p>
    <p id='departamento'><b>Departamento:</b> ${datosPregunta.categoria}</p>
</div>
<div class='atributos'>
    <div class='stats'>
        <div class='iconos'>
            <button class='botones'><i class='fa-solid fa-thumbs-up'></i></button>
            <b class='nums'>${datosPregunta.likes} LIKE</b>
        </div>
        <div class='iconos'>
            <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
            <b class='nums'>${datosPregunta.respuestas} RES</b>
        </div>
        <div class='iconos'>
            <button class='botones'><i class='fa-solid fa-eye'></i></button>
            <b class='nums'>${datosPregunta.vistos} VISTO</b>
        </div>
        <a class='res' href='?accion=detalles&id=${datosPregunta.id_preg}' onclick=\"actualizarVisto('${datosPregunta.id_preg}')\">Responder</a>
    </div>
</div>`;

    contenedorPregunta.appendChild(pregunta);
}

cargarPreguntas()
    .then( function(resultadoPromesa) {
        if (resultadoPromesa.mensaje) { // != undefined
            console.error(resultadoPromesa);
        } else {
            resultadoPromesa.forEach(datosPregunta => {
                cargarLayoutPregunta(datosPregunta);
            });
        }
    });
 









 

