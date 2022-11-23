<?php require('VIEWS/PARTIALS/header.php') ?>

<script src="JS/visto.js"></script>

<div class="visualizacion">
    <div class="recuadro">
        <form method="get">
                <input class="buscar" type="search" name="buscar" id="buscar" placeholder="Buscar..." autofocus>
                <select name="categoria" id="categoria" class="dep">
                    <option value="0">- SELECIONE UNA -</option>  
                </select>
                <select name="order" id="order" class="order">
                    <option value="0">Ordenar por... <i class="fa-solid fa-filter"></i></option>
                    <option value="masVistas">      + Vistas</option>
                    <option value="menosVistas">    - Vistas</option>
                    <option value="masVotadas">     + Votadas</option>
                    <option value="menosVotadas">   - Votadas</option>
                    <option value="masRespuestas">  + Respuestas</option>
                    <option value="menosRespuestas">- Respuestas</option>
                    <option value="masRecientes">   + Recientes</option>
                    <option value="menosRecientes"> - Recientes</option>
                </select>
                <button class="lupa"><i class="fa fa-search"></i></button>
                <input type="submit" id="guardar" hidden>
        </form>
    </div>
</div>

<script src="JS/categoria.js"></script>
<script src="JS/busqueda.js"></script>
<script src="JS/cargarPreguntas.js"></script>

<noscript>El navegador no soporta JavaScript</noscript>


<?php require('VIEWS/PARTIALS/footer.php') ?>