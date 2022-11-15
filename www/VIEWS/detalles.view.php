
    <div class="detalles">
        <div class="votacion">
            <a class="like" href="#1"><i class="fa-solid fa-sort-up"></i></a>
            <b id="votos" class="votos">VOTOS</b>
            <a class="like" href="#2"><i class="fa-solid fa-sort-down"></i></a>
        </div>
        <div class="user">
            <h3 id="titulousuario">Usuario</h3>
            <img class="perfil" src="../RECURSOS/IMAGES/user.png" alt="Foto de pergil">
            <form>
                <p class="clasificacion">
                  <input id="radio1" type="radio" name="estrellas" value="5">
                  <label for="radio1">★</label>
                  <input id="radio2" type="radio" name="estrellas" value="4">
                  <label for="radio2">★</label>
                  <input id="radio3" type="radio" name="estrellas" value="3">
                  <label for="radio3">★</label>
                  <input id="radio4" type="radio" name="estrellas" value="2">
                  <label for="radio4">★</label>
                  <input id="radio5" type="radio" name="estrellas" value="1">
                  <label for="radio5">★</label>
                </p>
              </form>
        </div>
        <div class="info">
            <h1>¿Pregunta?</h1>
            <p>Usuario: </p>
            <p>Fecha de publicación: </p>
            <p>Departamento: </p>
            <div class="descripcion">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi a ipsa aperiam, modi sapiente non praesentium aut ipsum voluptate. Sequi consectetur repellat hic veritatis quidem maiores minus qui architecto beatae. Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, rerum aperiam! Quo maxime esse iusto itaque aliquam officiis, voluptate placeat debitis amet voluptates consequuntur a inventore quae veniam rerum similique.
            </div>
        </div>
    </div>

    <div class="respuestas">
        <div class="respuesta">
            <div class="votacion">
                <a class="like" href="#1"><i class="fa-solid fa-sort-up"></i></a>
                <b id="votos" class="votos">VOTOS</b>
                <a class="like" href="#2"><i class="fa-solid fa-sort-down"></i></a>
            </div>
            <div class="user">
                <h3 id="titulousuario">Usuario</h3>
                <img class="perfil" src="../RECURSOS/IMAGES/user.png" alt="Foto de perfil">
                <form>
                    <p class="clasificacion">
                    <input id="radio1" type="radio" name="estrellas" value="5">
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="estrellas" value="4">
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="estrellas" value="3">
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="estrellas" value="2">
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="estrellas" value="1">
                    <label for="radio5">★</label>
                    </p>
                </form>
            </div>
            <div class="info">
                <b id="votos" class="votos">RESPUESTA</b>
                <div class="descripcion">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi a ipsa aperiam, modi sapiente non praesentium aut ipsum voluptate. Sequi consectetur repellat hic veritatis quidem maiores minus qui architecto beatae. Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, rerum aperiam! Quo maxime esse iusto itaque aliquam officiis, voluptate placeat debitis amet voluptates consequuntur a inventore quae veniam rerum similique.
                </div>
            </div>
        </div>
    </div>

    <div class="publicarRespuesta">
        <div class="recuadroFormu datos">
                <form method="post" action="">
                    <div class="izq">
                        <h2>RESPONDER</h2><br>
                        <label for="detalle">Detalle:</label>
                        <br>
                        <textarea class="inputs" name="detalle" id="detalle" cols="100" rows="10" maxlength="500" ></textarea>
                        <br> 
                        <b style="color:red" id="detalleIncorrecto" hidden>Detalle no puede estar vacio</b>
                        <br><br>
                    </div> 
                    <div class="der end">
                        <label for="archivo">Subir archivo</label>
                        <input class="inputs" type="file" name="archivo" id="archivo">
                    </div> 
                    <input class="inputs" type="submit" value="Responder" id="preguntar">
                </form>
            </div>
    </div>
   

    
