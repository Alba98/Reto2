/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

'use strict'


//Actuallizamos el visto de la pregunta a través del parametro id
async function actualizarVisto(id_preg) {
    let respuesta = await fetch('/PHP/API_get.php' + '?funcion=actualizarVisto&id='+id_preg);
   
    if (respuesta.ok) {
        return respuesta.json();
    } else {
        return {
            mensaje: 'Error en el servidor',
        };
    }
}