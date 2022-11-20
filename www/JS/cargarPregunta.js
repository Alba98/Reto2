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
                <div class='descripcion'>
                    ${datosPregunta.detalle}
                </div>
            </div>
        </div>`;

    contenedorPregunta.appendChild(pregunta);
}

function cargarLayoutResponder(datosPregunta) {
    let contenedorPregunta = document.getElementsByClassName("zonaPublicarRespuesta")[0];
    let pregunta = document.createElement('div');
    pregunta.classList.add('recuadroFormu');
    pregunta.classList.add('datos');

    pregunta.innerHTML = `
        <form method="post" action="">
            <div class="izq">
                <h2>RESPONDER</h2><br>
                <label for="detalleR">Detalle:</label>
                <br>
                <textarea class="inputs" name="detalleR" id="detalleR" cols="100" rows="10" maxlength="500" ></textarea>
                <br> 
                <b style="color:red" id="detalleIncorrecto" hidden>Detalle no puede estar vacio</b>
                <br><br>
                <input id="pregId" name="pregId" type="hidden" value="${datosPregunta.id_preg}">
            </div> 
            <div class="der end">
                <label for="archivo">Subir archivo</label>
                <input class="inputs" type="file" name="archivo" id="archivo">
            </div> 
            <input class="inputs" type="submit" value="Responder" id="responder">
        </form>
       `;

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
            cargarLayoutResponder(resultadoPromesa[0]);
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








 

