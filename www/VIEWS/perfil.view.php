<div id="perfil">
    <div class="datos recuadroFormu">
        <form method="post" action="">
            <div class="izq">
                <h2>DETALLES</h2><br>

                <label for="nombre">Nombre: </label>
                <input class="inputs" type="text" name="pnombre" id="nombre" value="<?php echo $infousuario['nombre'] ?>" disabled required=""><br><br>

                <label for="apellidos">Apellidos: </label>
                <input class="inputs" type="text" name="papellidos" id="apellidos" value="<?php echo $infousuario['apellidos'] ?>" disabled required=""><br><br>
      
                <label for="contraseniaBtn">Contraseña:</label>
                <input type="button" class="inputs" name="contraseña" id="contraseniaBtn" value="Cambiar contraseña" disabled><br>
                <div id="cambiarPASS">
                    <h3>Confirmación nueva contraseña</h3><br>

                    <label>Cambiar contraseña</label>
                    <input  class="inputs" type = "password" id = "contra1"><br>
            
                    <label>Confirmar contraseña </label>
                    <input  class="inputs" type = "password" id = "contra2"><br>
                    
                    <input type="button" onclick="matchPassword()" value="Cambiar">
                    <input type ="reset" value = "Reset"><br><br>

                </div>

                <label for="email">Email: </label>
                <input class="inputs" type="email" name="pemail" id="email" value="<?php echo $infousuario['email'] ?>" disabled required=""><br><br>
                <input class="inputs" type="submit" value="GUARDAR CAMBIOS" id="guardarPerfil" disabled>
            </div>
            <div class="der">
                <img src="../RECURSOS/IMAGES/user.png" alt="Foto de perfil" class="perfil"><br><br>
                <input class="inputs" type="file" name="pfoto" id="foto" disabled><br><br>
                <input type="button" value="EDITAR PERFIL" id="editar">
            </div>
        </form>
    
    </div>

 
    <script src="../JS/perfil.js"></script>
</div>
