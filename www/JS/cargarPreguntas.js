/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/


 let   preguntas = ''; //acceder a las preguntas
 let   botonPreguntar = document.getElementsByClassName('botones');


 botonPreguntar.addEventListener('click',()=>{
    if(preguntas<10){
        pregunta += 1;
        cargarPreguntas();
    }

 });

 
 let cargarPreguntas = async() =>{

    try {
        let pregunta = ('../PHP/pregunta.php?id_preg='+id_preg, 
        {
            method: 'POST',
            async: true,
            headers: { 'Content-Type': 'application/json;charset=utf-8' },
            body: JSON.stringify({"id_preg": id_preg})
        });
        console.log(pregunta);
        // Si la respuesta es correcta
           if(pregunta.status === 10){
            const datos = await pregunta.json(); //convertir datos JSON
            
            let preguntas = '';
            datos.results.forEach(pregunta => {
                preguntas += `
                <div class='preguntas'>
                <div class='user'>
                    <h2 class='titulousuario' id='titulousuario'>$preg->usuario</h2>
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
                    <h2>$preg->titulo</h2>
                    <p id='usuario'><b>Usuario:</b> $preg->usuario </p>
                    <p id='fecha'><b>Fecha:</b> $preg->fecha</p>
                    <p id='departamento'><b>Departamento:</b> $preg->categoria</p>
                </div>
                <div class='atributos'>
                    <div class='stats'>
                        <div class='iconos'>
                            <button class='botones'><i class='fa-solid fa-thumbs-up'></i></button>
                            <b class='nums'>$likes->like LIKE</b>
                        </div>
                        <div class='iconos'>
                            <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                            <b class='nums'>$respuestas->respuestas RES</b>
                        </div>
                        <div class='iconos'>
                            <button class='botones'><i class='fa-solid fa-eye'></i></button>
                            <b class='nums'>$preg->vistos VISTO</b>
                        </div>
                        <a class='res' href='?accion=detalles&id=$preg->id_preg' onclick=\"actualizarVisto('$preg->id_preg')\">Responder</a>
                    </div>
                </div>
            </div>";
                  
                `;
            });

            document.getElementsByClassName('preguntas').innerHTML = preguntas;
        
        } else if(respuesta.status === 401){
            console.log('Pusiste la llave mal');
        } else if(respuesta.status === 404){
            console.log('La pelicula que buscas no existe');
        } else {
            console.log('Hubo un error y no sabemos que paso');
        }

    } catch(error){
        console.log(error);
    }



 }

 cargarPreguntas();



















 

