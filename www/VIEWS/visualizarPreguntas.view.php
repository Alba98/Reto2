
<div class="visualizacion">
    <div class="datos">
        <form method="get">
                <input class="buscar" type="search" name="buscar" id="buscar" value="<?php if (isset($_GET['buscar'])) {
                    echo $_GET['buscar'];
                } ?>" placeholder="Buscar..." autofocus>
                <select name="dep" id="dep" class="dep">
                    <?php optionsCategoria() ?>
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
        
    <script src="../JS/cargarPreguntas.js"></script>

    </div>
    <script src="../JS/pregunta.js"></script>
    <?php
        $dbh = connect();
        

        if (isset($_GET['buscar']) && isset($_GET['dep']) && isset($_GET['order'])) {
            // SI SE LE DA A BUSCAR Y NO SE HA CAMBIADO NADA...
            if (isset($_GET['buscar']) && $_GET['dep'] == "0" && $_GET['order'] == "0") {
                $preguntas = getVistaPreguntas($dbh);
                foreach ($preguntas as $preg) {
                    $respuestas = countRespuestas($dbh,$preg->id_preg);
                    echo "
                    <div class='preguntas'>
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
                                <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                                <b class='nums'>$respuestas->respuestas RES</b>
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
            } elseif (isset($_GET['buscar']) && $_GET['dep'] == "0" && $_GET['order'] == "recientes") {
                // ORDENAREMOS POR PREGUNTAS RECIENTES
                $preguntas = getPreguntasRecientes($dbh);
                foreach ($preguntas as $preg) {
                    $respuestas = countRespuestas($dbh,$preg->id_preg);
                    echo "
                    <div class='preguntas'>
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
                                <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                                <b class='nums'>$respuestas->respuestas RES</b>
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
            } elseif (isset($_GET['buscar']) && $_GET['dep'] == "0" && $_GET['order'] == "masvistas") {
                // ORDENAREMOS POR MAS VISTAS
                $preguntas = getPreguntasMasVistas($dbh);
                foreach ($preguntas as $preg) {
                    $respuestas = countRespuestas($dbh,$preg->id_preg);
                    echo "
                    <div class='preguntas'>
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
                                <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                                <b class='nums'>$respuestas->respuestas RES</b>
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
            } elseif (isset($_GET['buscar']) && $_GET['dep'] == "0" && $_GET['order'] == "menosvistas") {
                // ORDENAREMOS POR MENOS VISTAS
                $preguntas = getPreguntasMenosVistas($dbh);
                foreach ($preguntas as $preg) {
                    $respuestas = countRespuestas($dbh,$preg->id_preg);
                    echo "
                    <div class='preguntas'>
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
                                <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                                <b class='nums'>$respuestas->respuestas RES</b>
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
            } elseif (isset($_GET['buscar']) && $_GET['order'] == "0") {
                // SELECCIONAR LAS PREGUNTAS POR CATEGORIA
                $preguntas = getPreguntasCategoria($dbh);
                foreach ($preguntas as $preg) {
                    $respuestas = countRespuestas($dbh,$preg->id_preg);
                    echo "
                    <div class='preguntas'>
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
                                <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                                <b class='nums'>$respuestas->respuestas RES</b>
                            </div>
                            <div class='iconos'>
                                <button class='botones'><i class='fa-solid fa-eye'></i></button>
                                <b class='nums'>$preg->vistos</b>
                            </div>
                            <a class='res' href='?accion=detalles&id=$preg->id_preg' onclick=\"actualizarVisto('$preg->id_preg')\">Responder</a>
                        </div>
                    </div>
                </div>";
                }}
                elseif (isset($_GET['buscar'])) {
                    // SELECCIONAR LAS PREGUNTAS POR CATEGORIA + MAS/MENOS VISTAS
                    $preguntas = getPreguntasMasVistasCategoria($dbh);
                    foreach ($preguntas as $preg) {
                        $respuestas = countRespuestas($dbh,$preg->id_preg);
                        echo "
                        <div class='preguntas'>
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
                                    <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                                    <b class='nums'>$respuestas->respuestas RES</b>
                                </div>
                                <div class='iconos'>
                                    <button class='botones'><i class='fa-solid fa-eye'></i></button>
                                    <b class='nums'>$preg->vistos</b>
                                </div>
                                <a class='res' href='?accion=detalles&id=$preg->id_preg' onclick=\"actualizarVisto('$preg->id_preg')\">Responder</a>
                            </div>
                        </div>
                    </div>";
                    }}
                
                
                
                
                elseif ($_GET['buscar'] != "" && $_GET['dep'] == "0" && $_GET['order'] == "0") {
                    // BUSQUEDA POR EL SEARCH --> NO LE APETECE IR
                    $preguntas = getPreguntasBuscar($dbh);
                    foreach ($preguntas as $preg) {
                        $respuestas = countRespuestas($dbh,$preg->id_preg);
                        echo "
                        <div class='preguntas'>
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
                                    <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                                    <b class='nums'>$respuestas->respuestas RES</b>
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
                }
        } else {
            $preguntas = getVistaPreguntas($dbh);
            foreach ($preguntas as $preg) {
                $respuestas = countRespuestas($dbh,$preg->id_preg);
                echo "
                <div class='preguntas'>
                <div class='user'>
                    <h2 class='titulousuario' id='titulousuario'>$preg->usuario</h2>
                    <img class='perfil' src='../RECURSOS/IMAGES/user.png' alt='Foto de perfil'>
                    <form>
                        <p class='clasificacion'>
                          <input id='radio1' type='radio' name='estrellas' value='1'>
                          <label for='radio1'>★</label>
                          <input id='radio2' type='radio' name='estrellas' value='2'>
                          <label for='radio2'>★</label>
                          <input id='radio3' type='radio' name='estrellas' value='3'>
                          <label for='radio3'>★</label>
                          <input id='radio4' type='radio' name='estrellas' value='4'>
                          <label for='radio4'>★</label>
                          <input id='radio5' type='radio' name='estrellas' value='5'>
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
                            <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
                            <b class='nums'>$respuestas->respuestas RES</b>
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
        }
    ?>
</div>

 <!-- <a class='res' href='?accion=detalles&id=$preg->id_preg' -->