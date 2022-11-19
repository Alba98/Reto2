<?php require('VIEWS/PARTIALS/header.php') ?>

    <?php include_once './PHP/publicarPregunta.php' ?>

    <div class="preguntar">
        <div class="datos recuadroFormu">
            <form method="post" action="">
                <div class="izq">
                    <h2>PREGUNTAR A OTROS USUARIOS</h2><br>
                    <label for="usuario">Usuario</label>
                    <input class="inputs" type="text" name="usuario" id="usuario" value="<?php echo $infousuario['nombre'] ?>" disabled required="">
                    <br><br>
                    <label for="titulo">Titulo</label>
                    <input class="inputs" type="text" name="titulo" id="titulo" maxlength="100" size="50">
                    <br> 
                    <b style="color:red" id="tituloIncorrecto" hidden>Titulo no puede estar vacio</b>
                    <br><br>
                    <label for="categoria">Categoria</label>
                    <select class="inputs" name="categoria" id="categoria">
                        <option value="0">- SELECIONE UNA -</option>
                        <!-- <?php optionsCategoria() ?> -->
                    </select>
                    <b style="color:red" id="categoriaIncorrecto" hidden>Escoja una categoria</b>
                    <br><br>
                    <label for="detalle">Detalle</label>
                    <textarea class="inputs" name="detalle" id="detalle" cols="50" rows="10" maxlength="500" ></textarea>
                    <br> 
                    <b style="color:red" id="detalleIncorrecto" hidden>Detalle no puede estar vacio</b>
                    <br><br>
                </div> 
                <div class="der end">
                    <label for="archivo">Subir archivo</label>
                    <input class="inputs" type="file" name="archivo" id="archivo">
                </div> 
                <input class="inputs" type="submit" value="Enviar" id="preguntar">
            </form>
        </div>
        <script src="../JS/categoria.js"></script>
        <script src="../JS/preguntar.js"></script>
    </div>

<?php require('VIEWS/PARTIALS/footer.php') ?>