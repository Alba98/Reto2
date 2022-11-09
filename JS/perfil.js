document.getElementById("editar").addEventListener("click",edit);

function edit() {
    let inputs = document.getElementsByClassName("inputs");
    for (let x = 0; x < inputs.length; x++) {
        inputs[x].disabled = false;
    }
}