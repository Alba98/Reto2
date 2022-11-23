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
//let saveEmail  = document.getElementById('btn-login').addEventListener('click',guardarCookie);
let savePerfil = document.getElementById('guardarPerfil').addEventListener('click',guardarCookie); 


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


//Aqui leemos la cookie
function getCookie(nombre){
    let buscarCookie = nombre + "=";
    let crear_cookie  = document.cookie.split(';');
    for (let i=0; i<crear_cookie.length;i++){
        let c = crear_cookie[i];
        while ( c.charAt(0) == ' '){
            c = c.substring(1,c.length); 
            if (c.indexOf(nameEQ) == 0){
                return c.substring(buscarCookie.length,c.length);
            }
        }
        return null;    
    } 
}

//Almacenamos la cokie
function guardarCookie() {
    //debugger;
    let coE = document.getElementsByName('pemail')[0].value;
    let coN = document.getElementsByName('pnombre')[0].value;
    let coA = document.getElementsByName('papellidos')[0].value;
    console.log(coE);
    console.log(coN);
    console.log(coA);
    console.log(crearCookie("Email",coE,30));
    console.log(crearCookie("Nombre ",coN,30));
    console.log(crearCookie("Apellido",coA,30));

}
//Borramos la cookie 
function borrarCookie(nombre) {
	crearCookie(nombre,"",-1);
}




