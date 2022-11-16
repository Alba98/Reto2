<?php
        $dbh = connect();
        $preguntas = getPregunta($dbh);
        foreach ($preguntas as $preg) {
            echo "<div class='detalles'>
            <div class='votacion'>
                <a class='like' href='#1'><i class='fa-solid fa-sort-up'></i></a>
                <b id='votos' class='votos'>VOTOS</b>
                <a class='like' href='#2'><i class='fa-solid fa-sort-down'></i></a>
            </div>
            <div class='user'>
                <h3 class='titulousuario' id='titulousuario'>$preg->usuario</h3>
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
                <h1>$preg->titulo</h1>
                <p><b>Usuario:</b> $preg->usuario</p>
                <p><b>Fecha de publicación:</b> $preg->fecha</p>
                <p><b>Departamento:</b> $preg->categoria</p>
                <div class='descripcion'>
                    $preg->detalle
                </div>
            </div>
        </div>";
        }
?>

<?php
    $dbh = connect();
    $respuestas = getRespuestas($dbh);
    foreach ($respuestas as $res) {
        echo "<div class='respuestas'>
        <div class='respuesta'>
            <div class='votacion'>
                <a class='like' href='#1'><i class='fa-solid fa-sort-up'></i></a>
                <b id='votos' class='votos'>VOTOS</b>
                <a class='like' href='#2'><i class='fa-solid fa-sort-down'></i></a>
            </div>
            <div class='user'>
                <h3 class='titulousuario' id='titulousuario'>$res->usuario</h3>
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
                $res->descripcion
                </div>
            </div>
        </div>
    </div>";
    }
?>
    

    <div class="publicarRespuesta">
        <div class="recuadroFormu datos">
            <form method="post" action="">
                <div class="izq">
                    <h2>RESPONDER</h2><br>
                    <label for="detalle">Detalle:</label>
                    <br>
                    <textarea class="inputs" name="detalle" id="detalleR" cols="100" rows="10" maxlength="500" ></textarea>
                    <br> 
                    <b style="color:red" id="detalleIncorrecto" hidden>Detalle no puede estar vacio</b>
                    <br><br>
                </div> 
                <div class="der end">
                    <label for="archivo">Subir archivo</label>
                    <input class="inputs" type="file" name="archivo" id="archivo">
                </div> 
                <input class="inputs" type="submit" value="Responder" id="responder">
            </form>
        </div>
        <script src="../JS/responder.js"></script>
    </div>

    <br><br>

    
