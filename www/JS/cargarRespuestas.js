/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Vamos a guardar la URL (no es la ruta de los archivos , si no del HTTP)


async function cargarRespuesta() {
    let respuesta = await fetch(API_URL + '?funcion=getRespuestas&id=1') // con '?' separamos la ruta de los parametros
                        /*El await espera al resultado de la promesa que devuelve la funcion asincrona*/
   
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

function cargarLayoutRespuesta(datosPregunta) {
    let contenedorPregunta = document.getElementsByClassName("zonaRespuestas")[0];
    let pregunta = document.createElement('div');
    pregunta.classList.add('respuesta');

    pregunta.innerHTML = `
                <div class='votacion'>
                    <a class='like' href='#1'><i class='fa-solid fa-sort-up'></i></a>
                    <b id='votos' class='votos'>${datosPregunta.votos} VOTOS</b>
                    <a class='like' href='#2'><i class='fa-solid fa-sort-down'></i></a>
                </div>
                <div class='user'>
                    <h3 class='titulousuario' id='titulousuario'>${datosPregunta.usuario}</h3>
                    <img class='perfil' src='../RECURSOS/IMAGES/user.png' alt='Foto de perfil'>
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
                    <b class=''>SOLUCIÓN</b>
                    <div class='descripcion'>
                        <p> ${datosPregunta.descripcion} </p>
                    </div>
                </div>`;

    contenedorPregunta.appendChild(pregunta);
}

cargarRespuesta()
    .then( function(resultadoPromesa) {
        debugger;
        if (resultadoPromesa.mensaje) { // != undefined
            console.error(resultadoPromesa);
        } else {
            resultadoPromesa.forEach(datosPregunta => {
                cargarLayoutRespuesta(datosPregunta);
            });
        }
});
 









 

