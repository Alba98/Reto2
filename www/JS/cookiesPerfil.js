/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 */

/************************************************************************************************
I)Para leer la cookie, buscamos el nombre y vemos qué valor tiene.Después leemos este valor y
decidimos qué valor(es) puede tener la cookie y escribimos los scripts para tratar con estos valores.

II)Cada cookie tiene una fecha de caducidad después de la cual se borra.
Si no se especifica la fecha de caducidad, la cookie se borra cuando 
se cierra el navegador.Esta fecha de caducidad debe estar en hora UTC(Greenwich).
************************************************************************************************/


//Evento para acceder a la cookie:
let savePerfil  = document.getElementById('guardarPerfil')
if (savePerfil) {
    savePerfil.addEventListener('click',guardarCookie);
}
/*
let cerrarSesionCookie  = document.getElementById('cerrarSesion')
if (cerrarSesionCookie) {
    cerrarSesionCookie.addEventListener('click',deleteCookies);
}
*/


//let savePerfil = document.getElementById('guardarPerfil').addEventListener('click',guardarCookie); 


//Al llamar a createCookie() hay que darle tres datos: el nombre y el valor de la cookie y el número de días que debe permanecer activa. 
function crearCookie(nombre,valor,dias){
    let expirarCookie = "";
    //En primer lugar, comprueba si hay un valor de días.
    if (dias){
       //Crea un nuevo objeto Date que contiene la fecha actual.
        let fecha = new Date();
        /*Obtenemos la Hora actual (en milisegundos) y añadimos el número de días requerido(en milisegundos).
        Establecemos el Tiempo de la fecha a este nuevo valor, para que ahora contenga la fecha en milisegundos en que la cookie debe expirar.*/
        fecha.setTime(fecha.getTime()+(dias*24*60*60*1000));
        expirarCookie = ";expirarCookie=" + fecha.toUTCString();
    }
    //Con document.cookie se obtienen y definen las cookies asociadas con el documento.
    document.cookie = nombre + " = " + ( valor || " ") + expirarCookie;
}//Cookie creada. 


//La siguiente funcion obtiene el valor de una cookie usando el nombre de la cookie.
function getCookie(nombre){
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${nombre}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

//Almacenamos la cookie después de haber accido a los eventos del formulario del registro:
function guardarCookie(nombre) {
    let coE = document.getElementsByName('pemail')[0].value;
    let coN = document.getElementsByName('pnombre')[0].value;
    let coA = document.getElementsByName('papellidos')[0].value;
    (crearCookie("Email",coE,30));
    (crearCookie("Nombre",coN,30));
    (crearCookie("Apellido",coA,30));
    console.log(document.cookie);
}


//Borramos la cookie desde PHP al cerrar sesion:
/*
//Borramos la cookie 
function deleteCookies() {
    document.cookie = "Email=; max-age=0";
    document.cookie = "Nombre=; max-age=0";
    document.cookie = "Apellido=; max-age=0";
    
}
*/


