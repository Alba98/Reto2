<div id="perfil">
    <div class="datos recuadroFormu">
        <form method="post">
            <div class="izq">
                <h2>DETALLES</h2><br>
                <label for="nombre">Nombre: </label>
                <input class="inputs" type="text" name="nombre" id="nombre" disabled><br><br>
                <label for="apellidos">Apellidos: </label>
                <input class="inputs" type="text" name="apellidos" id="apellidos" disabled><br><br>
                <label for="contraseña">Contraseña: </label>
                <input class="inputs" type="text" name="contraseña" id="contraseña" onfocusout="nuevaContrasenia()" disabled><br><br>
                <div id="pswd_info">
                    <p>Contraseña Actual: <input type="password" name="passwordActual"></p>
                    <p>Nuevo contraseña:  <input type="password"  name="passwordNew1"></p>
                    <p>Repite la nueva contraseña: <input type="password" name="passwordNew2"></p>
                    <input type="submit" value="Modificar Password">
                </div>

                <label for="email">Email: </label>
                <input class="inputs" type="text" name="email" id="email" disabled><br><br>
                <input class="inputs" type="submit" value="GUARDAR CAMBIOS" id="guardar" disabled>
            </div>
            <div class="der">
                <img src="../RECURSOS/IMAGES/user.png" alt="Foto de perfil" class="perfil"><br><br>
                <input class="inputs" type="file" name="foto" id="foto" disabled><br><br>
                <input type="button" value="EDITAR PERFIL" id="editar">
            </div>
        </form>
    </div>
    <script src="../JS/perfil.js"></script>
</div>
