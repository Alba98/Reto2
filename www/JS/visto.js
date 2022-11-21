/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

'use strict'


// async function actualizarVisto(id_preg) {
//     fetch('/PHP/API_get.php?funcion=actualizarVisto&id='+id_preg, 
//         {
//             method: 'POST',
//             async: true,
//             headers: { 'Content-Type': 'application/json;charset=utf-8' },
//             body: JSON.stringify({"id_preg": id_preg})
//         })
//     .then(function(response) {
//         debugger;
//         return response.json ();
//     })
//     .then(function(data) {
//         debugger;
//         console.log('data = ', data);
//     })
//     .catch(function(err) {
//         console.log(err);
//     });
// }

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