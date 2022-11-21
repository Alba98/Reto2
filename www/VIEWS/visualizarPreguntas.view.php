<?php require('VIEWS/PARTIALS/header.php') ?>

<script src="JS/visto.js"></script>

<div class="visualizacion">
    <div class="datos recuadro">
        <form method="get">
                <input class="buscar" type="search" name="buscar" id="buscar" value="<?php if (isset($_GET['buscar'])) {
                    echo $_GET['buscar'];
                } ?>" placeholder="Buscar..." autofocus>
                <!-- <input class="buscar" type="search" name="buscar" id="buscar" placeholder="Buscar..." autofocus> -->
                <!-- <select name="dep" id="dep" class="dep">  -->
                <select name="categoria" id="categoria" class="dep">
                    <option value="0">- SELECIONE UNA -</option>  
                </select>
                <select name="order" id="order" class="order">
                    <option value="0">Ordenar por... <i class="fa-solid fa-filter"></i></option>
                    <option value="masvistas">+Vistas</option>
                    <option value="menosvistas">-Vistas</option>
                    <option value="masvotadas">+Votadas</option>
                    <option value="menosvotadas">-Votadas</option>
                    <option value="recientes">Recientes</option>
                </select>
                <button class="lupa"><i class="fa fa-search"></i></button>
                <input type="submit" id="guardar" hidden>
        </form>
    </div>
</div>

<script src="JS/categoria.js"></script>
<script src="JS/cargarPreguntas.js"></script>


<?php require('VIEWS/PARTIALS/footer.php') ?>
 <!-- <a class='res' href='?accion=detalles&id=$preg->id_preg' -->