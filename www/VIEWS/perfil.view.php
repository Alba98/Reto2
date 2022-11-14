<div id="perfil">
    <div class="datos recuadroFormu">
        <form method="post">
            <div class="izq">
                <h2>DETALLES</h2><br>

                <label for="nombre">Nombre: </label>
                <input class="inputs" type="text" name="nombre" id="nombre" disabled><br><br>

                <label for="apellidos">Apellidos: </label>
                <input class="inputs" type="text" name="apellidos" id="apellidos" disabled><br><br>
      
                <label for="contraseniaBtn">Contraseña:</label>
                <input type="button" class="inputs" name="contraseña" id="contraseniaBtn" value="Cambiar contraseña" disabled><br>
                <div id="cambiarPASS">
                    <h3>Confirmación nueva contraseña</h3><br>

                    <label>Cambiar contraseña</label>
                    <input type = "password" id = "contra1"><br>
            
                    <label>Confirmar contraseña </label>
                    <input type = "password" id = "contra2"><br>
                    
                    <button type="submit"   onclick="matchPassword()">Cambiar</button>
                    <button type = "reset"  value = "Reset">Reset</button><br><br>

                </div>

                <label for="email">Email: </label>
                <input class="inputs" type="text" name="email" id="email" disabled><br><br>
                <input class="inputs" type="submit" value="GUARDAR CAMBIOS" id="guardarPerfil" disabled>
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
