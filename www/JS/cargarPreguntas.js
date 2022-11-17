/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

 'use strict'

 async function fPreguntas(id_preg) {
     console.log('JS pregunta = ', id_preg);
     debugger;
     fetch('../PHP/visualizarPreguntas.view.php', {
             method: 'POST',
             async: true,
             headers: { 'Content-Type': 'application/json;charset=utf-8' },
             body: JSON.stringify({"id_preg": id_preg})
         })
     .then(function(response) {
         return response.json ();
     })
     .then(function(data) {
         console.log('data = ', data);
     })
     .catch(function(err) {
         console.error(err);
     });
 }

/*<?php
        $dbh = connect();
        $preguntas = getVistaPreguntas($dbh);

        foreach ($preguntas as $preg) {
            $respuestas = countRespuestas($dbh,$preg->id_preg);
            echo "
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
                        <b class='nums'>210k</b>
                    </div>
                    <div class='iconos'>
                        <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                        <b class='nums'>$respuestas->respuestas RES</b>
                    </div>
                    <div class='iconos'>
                        <button class='botones'><i class='fa-solid fa-eye'></i></button>
                        <b class='nums'>$preg->vistos</b>
                    </div>
                    <a class='res' href='?accion=detalles&id=$preg->id_preg' onclick=\"actualizarVisto('$preg->id_preg')\">Responder</a>
                </div>
            </div>
        </div>";
        
        }
    ?>

    
</div>

 <!-- <a class='res' href='?accion=detalles&id=$preg->id_preg' -->*/