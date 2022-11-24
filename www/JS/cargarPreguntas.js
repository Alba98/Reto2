/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/


/*La mayoría del código es identíco en el archivo cargarPregunta.js , por lo que la mayoría de la documentación
se recoge en ese script.*/


// let categoria = document.getElementById("categoria")

//Vamos a guardar la URL (no es la ruta de los archivos , si no del HTTP)
const API_URL = '/PHP/API_get.php';

async function cargarPreguntas() {
    let respuesta = await fetch(API_URL + '?funcion=getPreguntas' + getBuscar() + getCategoria() + getOrder()) // con '?' separamos la ruta de los parametros
                        /*El await espera al resultado de la promesa que devuelve la funcion asincrona*/
   
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}

function getBuscar() {
    if(buscar.value)
        return '&buscar='+buscar.value;
    return '';
}

function getCategoria() { 
    if(urlParams.has('categoria') && urlParams.get('categoria') != 0) 
        return '&categoria='+urlParams.get('categoria');
    // if(categoria.value != 0)
    //     return '&categoria='+categoria.value;
    return '';
}

function getOrder() {
    if(orden.value != 0)
        return '&order='+orden.value;
    return '';
}

function setValoracion(valoracion,num) {
    if (valoracion == num) {
        return "checked";
    } else return "";
}

function cargarLayoutPregunta(datosPregunta) {
    let contenedorPregunta = document.getElementsByClassName("visualizacion")[0];
    let pregunta = document.createElement('div');
    pregunta.classList.add('pregunta');
    pregunta.classList.add('recuadro');

    pregunta.innerHTML = `<div class='user'>
    <h2 class='titulousuario' id='titulousuario'>${datosPregunta.usuario}</h2>
    <img class='perfil' src='../RECURSOS/IMAGES/user.png' alt='Foto de perfil'>
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
    <h2>${datosPregunta.titulo}</h2> <br>
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
        <a class='res' href='?accion=detalles' onclick=\"actualizarVisto('${datosPregunta.id_preg}')\">Detalle</a>
    </div>
</div>`;

    //Obtenemos el boton para añadir un evento click
    let respuestasBoton = pregunta.getElementsByClassName('res')[0];
    respuestasBoton.addEventListener('click', (e) => {
    //Establece el id_preg dentro del localStorage
    //Obtenemos datosPregunta de la API y obtenemos el id de la pregunta
        localStorage.setItem("idPregunta", datosPregunta.id_preg);
    });

    contenedorPregunta.appendChild(pregunta);
}

//Funcion para cargar los detalles de la pregunta desde la vista creada en la BBDD
cargarPreguntas()
    .then( function(resultadoPromesa) {
        if (resultadoPromesa.mensaje) { // != undefined
            console.error(resultadoPromesa);
        } else {
            resultadoPromesa.forEach(datosPregunta => {
                cargarLayoutPregunta(datosPregunta);
            });
        }
    }
);




   








 









 

