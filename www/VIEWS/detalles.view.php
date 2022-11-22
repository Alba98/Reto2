<?php require('VIEWS/PARTIALS/header.php') ?>

    <div class="zonaPregunta"></div>
    <div class="zonaRespuestas"></div>
    <div class="zonaPublicarRespuesta">
        <div class="recuadro">
            <form method="post" action="#" class="formulario">
                <div class="izq">
                    <h2>RESPONDER</h2><br>
                    <label for="detalleR">Detalle:</label>
                    <br>
                    <textarea class="inputs" name="detalleR" id="detalleR" cols="80" rows="10" maxlength="500" ></textarea>
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
    </div>

    <script src="JS/cargarPregunta.js"></script>
    <script src="JS/cargarRespuestas.js"></script>
    <!-- Formulario publicar pregunta -->
    <script src="JS/responder.js"></script>
    <br><br>

<?php require('VIEWS/PARTIALS/footer.php') ?>
