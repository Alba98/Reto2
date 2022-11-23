/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 ************************/


//Evento para acceder a la cookie:

let nombreC = document.getElementsByClassName('inputs').addEventListener('click',guardarCookie);
let emailC = document.getElementById('btn-login').addEventListener('click',guardarCookie);



function setCookie(nombre,valor,dias){
    let expirarCookie = "";
    if (dias){
        let fecha = new Date();
        fecha.setTime(fecha.getTime()+(dias*24*60*60*1000));
        expirarCookie = ";expirarCookie=" + fecha.toUTCString(); //Una cadena que representa la fecha dada usando la zona horaria UTC 
    }
    document.cookie = nombre + " = " + ( valor || " ") + expirarCookie + ":path=/";
}

//Aqui leemos la cookie
function getCookie(nombre){
    let buscarCookie = nombre + "=";
    let crearCookie  = document.cookie.split(';');
    for (let i=0; i<crearCookie.length;i++){
        let c = crearCookie[i];
        while ( c.charAt(0) == ' '){
            c = c.substring(1,c.length); 
            if (c.indexOf(nameEQ) == 0){
                return c.substring(buscarCookie.length,c.length);
            }
        }
        return null;    
    } 
}

function guardarCookie() {
    //debugger;
    let co =document.getElementsByName('email')[0].value;

    console.log(co);
    console.log(setCookie("email",co,30));
}

function borrarCookie(nombre) {
	setCookie(nombre,"",-1);
}



