function sobreMim(){
    var editButton = document.getElementById("Editar");
    var abouteMeTextArea = document.getElementById("textosobremim");
    var saveButton = document.getElementById("Salvar");

        if(editButton.value == ("Editar")){
            editButton.value = ("Cancelar");
            abouteMeTextArea.disabled = false;
            saveButton.disabled = false;
            saveButton.style.opacity = 1;
        }else{
            editButton.value = ("Editar");
            abouteMeTextArea.disabled = true;
            saveButton.disabled = true;
            saveButton.style.opacity = 0.5;
        }
}

function sizePublicacoes(){
    var publicacoesUser = document.getElementById("publicacoesUser");

        if(publicacoesUser.style.height == "72%"){
            publicacoesUser.style.height = "0%";
        }else{
            publicacoesUser.style.height = "72%";
        }
}