<?php

include("headerSemLogin.php");

$arqhtml = '<!DOCTYPE html>

<html>

<head>
    <title>GWV</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Esqueceuconta.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="scriptES.js"></script>
</head>

<body>
        <form action="esqueceucontaSistema.php" method="post">
            <div class="telaFundo">
                <img class="imgfundo" src="imgs/esqueceuasenha.jpg">
                <div class="areaFormulario">
                    <Label class="tituloFormulario">Insira suas informações</label>
                    <div class="iconesFormulario">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                    <input class="camposFormulario" type="text" placeholder="Email" id="email" name="email">
                    <div class="BotaoCadastrar">
                        <input type="submit" value="Enviar Solicitação">
                    </div>
        </form>
        </div>
</body>

</html>';

echo $arqhtml;

include("footer.php");
