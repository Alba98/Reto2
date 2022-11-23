/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Eventos
document.getElementById("editar").addEventListener("click",edit);
document.getElementById("contraseniaBtn").addEventListener("click", mostrarMenu);
document.getElementById("contra2").addEventListener("focusout", matchPassword);
document.getElementById("nombre").addEventListener("focusout", validarNombre);
document.getElementById("apellidos").addEventListener("focusout", validarApellidos);
document.getElementById("email").addEventListener("focusout", validarEmail);
document.getElementById('foto').addEventListener('change', handleFileSelect, false);
document.getElementById('his').addEventListener('click',verHistorial);

//document.getElementById("guardarPerfil").addEventListener("click", validarFormulario);

function edit() {
    let inputs = document.getElementsByClassName("inputs");
    for (let x = 0; x < inputs.length; x++) {
        inputs[x].disabled = false;
    }
}

function mostrarMenu(){
    let menu = document.getElementById("cambiarPASS");
    menu.classList.toggle("shown");
}

function matchPassword(){
    let pass1 = document.getElementById("contra1").value;
    let pass2 = document.getElementById("contra2").value;
    if(pass1 != pass2){	
        document.getElementById("passIncorrecta").hidden = false;
    } else {
        document.getElementById("passIncorrecta").hidden = true;
    }
}

function validarNombre() {
    let nom = document.getElementById('nombre').value;
    let exRegName  =  new RegExp (/^[A-Z]{1}[a-z]+$/);
    if (!exRegName.test(nom)){
        document.getElementById("nombre").focus();
        document.getElementById("nombreIncorrecto").hidden = false;
    } else {
        document.getElementById("nombreIncorrecto").hidden = true;
    }
}

function validarApellidos() {
    let apellido = document.getElementById('apellidos').value;
    let exRegName  =  new RegExp (/^[A-Z]{1}[a-z]+$/);
    if (!exRegName.test(apellido)){
        document.getElementById("apellidos").focus();
        document.getElementById("apellidosIncorrectos").hidden = false;
    } else {
        document.getElementById("apellidosIncorrectos").hidden = true;
    }
}

function validarEmail() {
    let email = document.getElementById('email').value;
    let exRegEmail =  new RegExp ('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$');
    if (!exRegEmail.test(email)){
        document.getElementById("email").focus();
        document.getElementById("emailIncorrecto").hidden = false;
    } else {
        document.getElementById("emailIncorrecto").hidden = true;
    }
}

/* GUARDAR LA IMAGEN EN LOCALSTORAGE */
function handleFileSelect(evt) {
    
    var files = evt.target.files; // FileList object
    localStorage.removeItem('img'); // Para que no hayan 2 imagenes

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Solo procesa imagenes.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Creamos un span con la imagen
          var span = document.createElement('span');
          span.innerHTML = ['<img id="fperfilnueva" class="perfil" src="', e.target.result,
            '"/>'
          ].join('');

          document.getElementById('list').insertBefore(span, null);
          localStorage.setItem('img', e.target.result);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
      document.getElementById('fotoperfil').hidden = true;
    }
  }

  // Si tenenemos una imagen en LocalStorage...
  if (localStorage.img) {
    var span = document.createElement('span');
    span.innerHTML += ['<img class="perfil" src="', localStorage.img,
      '"/>'
    ].join('');

    document.getElementById('list').insertBefore(span, null);
  } else {
    // Ocultamos la imagen por defecto del usuario
    document.getElementById('fotoperfil').hidden = false;
  }

  


const API_URL = '/PHP/API_get.php';
async function cargarPreguntasUsuario(id_usuario) {
  let respuesta = await fetch(API_URL + '?funcion=getPreguntasUsuario&usuario=' + id_usuario) // con '?' separamos la ruta de los parametros
                      /*El await espera al resultado de la promesa que devuelve la funcion asincrona*/
 
  if (respuesta.ok) {
      return respuesta.json();
  } else {
      return {
          mensaje: 'Error en el servidor',
      };
  }
}


function cargarLayoutPregunta(datosPregunta) {
  let contenedorPregunta = document.getElementsByClassName("uwu")[0];
  let pregunta = document.createElement('div');
  pregunta.classList.add('pregunta');
  pregunta.classList.add('recuadro');

  pregunta.innerHTML = `<div class='user'>
  <h2 class='titulousuario' id='titulousuario'>${datosPregunta.usuario}</h2>
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
  <h2>${datosPregunta.titulo}</h2> <br>
  <p id='usuario'><b>Usuario:</b>${datosPregunta.usuario} </p>
  <p id='fecha'><b>Fecha:</b> ${datosPregunta.fecha}</p>
  <p id='departamento'><b>Departamento:</b> ${datosPregunta.categoria}</p>
</div>
<div class='atributos'>
  <div class='stats'>
      <div class='iconos'>
          <button class='botones'><i class='fa-solid fa-thumbs-up'></i></button>
          <b class='nums'>${datosPregunta.likes} LIKE</b>
      </div>
      <div class='iconos'>
          <button class='botones'><i class='fa-brands fa-teamspeak'></i></button>
          <b class='nums'>${datosPregunta.respuestas} RES</b>
      </div>
      <div class='iconos'>
          <button class='botones'><i class='fa-solid fa-eye'></i></button>
          <b class='nums'>${datosPregunta.vistos} VISTO</b>
      </div>
      <a class='res' href='?accion=detalles' onclick=\"actualizarVisto('${datosPregunta.id_preg}')\">Responder</a>
  </div>
</div>`;

  //Obtenemos el boton para añadir un evento click
  let respuestasBoton = pregunta.getElementsByClassName('res')[0];
  respuestasBoton.addEventListener('click', (e) => {
  //Establece el id_preg dentro del localStorage
  //Obtenemos datosPregunta de la API y obtenemos el id de la pregunta
      localStorage.setItem("idPregunta", datosPregunta.id_preg);
  });

  contenedorPregunta.appendChild(pregunta);
}

//Mostrar historial con IndexedDB.Es una manera de almacenar datos de manera persistente en el navegador

/*Creamos la base de datos a través del objeto indexedDB*/

let db;
const indexedDB = window.indexedDB; //desciende del objeto window
if(indexedDB){

  // borrar la base de datos para volver a solicitar la informacion
  indexedDB.deleteDatabase('historial');
  //Almacena la base de datos y recibe dos paramentros, el nombre y la version , respectivamente
  const request = indexedDB.open('historial',1);
  //Métodos asíncronos:
  request.onsuccess=()=>{
    db = request.result;
    console.log('OPEN',db);

    // cargar los datos si no existen
    cargarPreguntasUsuario(getCookie('Nombre')).then((listaPreguntas) => {
      const transaction = db.transaction('historial','readwrite');
      const objectStore = transaction.objectStore('historial');

      for (let pregunta of listaPreguntas) {
        objectStore.add(pregunta);
      }

      transaction.commit();
    });
  }
  /*Comprobamos si la base de datos existe o tiene que ser creada a través del método onupgradeneeded()*/
  request.onupgradeneeded=()=>{
    db = request.result;
    console.log('CREATE',db);
    /*Crear almacén de objetos con el método crearObjectStorage()*/
    const objectStore = db.createObjectStore('historial', {
      keyPath: 'id_preg'
    });
  }
  request.onerror=(error)=>{
     console.log('ERROR',error);
  }

}

function verHistorial(e){
  if(indexedDB){
    const transaction = db.transaction('historial','readwrite');
    const objectStore = transaction.objectStore('historial');
    const request = objectStore.getAll();

    request.onsuccess = (e) => {
        let preguntas = e.target.result;

        for (let pregunta of preguntas) {
          cargarLayoutPregunta(pregunta);
        }
    };
  }
}



