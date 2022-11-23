<?php require('VIEWS/PARTIALS/header.php') ?>

    <div class="preguntar">
        <div class="recuadro">
            <form method="post" action="?accion=preguntas" class="formulario">
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
                        <!-- <?php   // optionsCategoria() ?>  -->
                    </select>
                    <b style="color:red" id="categoriaIncorrecto" hidden>Escoja una categoria</b>
                    <br><br>
                    <label for="detalle">Detalle</label>
                    <textarea class="inputs" name="detalle" id="detalle" cols="50" rows="10" maxlength="500" ></textarea>
                    <br> 
                    <b style="color:red" id="detalleIncorrecto" hidden>Detalle no puede estar vacio</b>
                </div> 
                <div class="der end">
                    <label for="archivo">Subir archivo</label>
                    <input class="inputs" type="file" name="parchivo" id="archivo">
                </div>
                <div  class="formulario">
                    <div  class="izq">
                        <br>
                        <input class="inputs" type="submit" value="Enviar" id="preguntar"> 
                    </div>
                </div>
                
            </form>
        </div>
        <script src="../JS/categoria.js"></script>
        <script src="../JS/preguntar.js"></script>

        <noscript>El navegador no soporta JavaScript</noscript>
    </div>

<?php require('VIEWS/PARTIALS/footer.php') ?>