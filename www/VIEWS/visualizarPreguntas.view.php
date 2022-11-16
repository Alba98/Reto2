
<div class="visualizacion">
    <div class="datos">
        <form method="get">
                <input class="buscar" type="search" name="buscar" id="buscar" placeholder="Buscar..." autofocus>
                <select name="dep" id="dep" class="dep">
                    <option value="-1">Seleccione un departamento</option>
                </select>
                <select name="order" id="order" class="order">
                    <option value="-1">Ordenar por... <i class="fa-solid fa-filter"></i></option>
                    <option value="+vi">+Vistas</option>
                    <option value="-vi">-Vistas</option>
                    <option value="+vo">+Votadas</option>
                    <option value="-vo">-Votadas</option>
                    <option value="recientes">Recientes</option>
                </select>
                <button class="lupa"><i class="fa fa-search"></i></button>
                <input type="submit" id="guardar" hidden>

        </form>
    </div>


    <script src="../JS/pregunta.js"></script>

    <?php
        $dbh = connect();
        $preguntas = getVistaPreguntas($dbh);

        foreach ($preguntas as $preg) {
            echo "<div class='preguntas'>
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
                        <button class='botones'><i class='fa-solid fa-check'></i></button>
                        <b class='nums'>434k</b>
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

 <!-- <a class='res' href='?accion=detalles&id=$preg->id_preg' -->