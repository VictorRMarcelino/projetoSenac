function inicio() {
    var password = document.getElementById("senha");
    var checkbox = document.getElementById("checkbox");
    var Tcheckbox = document.getElementById("Tcheckbox");

    if (checkbox.checked === true) {
        password.type = "password";
        Tcheckbox.innerHTML = "Revelar Senha";
    } else {
        password.type = "text";
        Tcheckbox.innerHTML = "Esconder Senha";
    }

}

function mudar() {
    var botaoEditar = document.getElementById("Editar");


    if (botaoEditar.innerHTML === "Editar") {
        botaoEditar.innerHTML = "Salvar";
    } else {
        botaoEditar.innerHTML = "Editar";
    }
}