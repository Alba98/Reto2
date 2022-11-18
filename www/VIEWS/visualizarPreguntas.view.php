<?php require('VIEWS/PARTIALS/header.php') ?>

<div class="visualizacion">
    <div class="datos">
        <form method="get">
                <input class="buscar" type="search" name="buscar" id="buscar" placeholder="Buscar..." autofocus>
                <select name="dep" id="dep" class="dep">
                    <?php optionsCategoria(); ?>
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
</div>
<script src="JS/cargarPreguntas.js"></script>

<?php require('VIEWS/PARTIALS/footer.php') ?>
 <!-- <a class='res' href='?accion=detalles&id=$preg->id_preg' -->