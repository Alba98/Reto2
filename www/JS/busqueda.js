let buscar = document.getElementById("buscar");
let categoria = document.getElementById("categoria");
let orden = document.getElementById("order");

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

if(urlParams.has('buscar')) {   
    buscar.value = urlParams.get('buscar');
}

if(urlParams.has('categoria')) {    
    categoria.value = urlParams.get('categoria');

    console.log(categoria);
    console.log(categoria.value);
}

if(urlParams.has('order')) {
    orden.value = urlParams.get('order');
}