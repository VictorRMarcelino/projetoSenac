<?php

$arqHtml= '<!DOCTYPE html>
<html>
    <head>
        <title>GWV</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/headerSemLogin.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="js/scriptEsconderSenha.js"></script>
        <script src="js/scriptErroAcessarPagina.js"></script>
    </head>
    <body onload="inicio()">
    <header>
    <div class="banner">
        <section class="itens_banner">
            <nav>
                <div class="titulo IconeLogo">
                    <h1 onclick="erroAcessarPagina()">GWV</h1>
                </div>
            </nav>

            <nav>
                <div class="Amigos">
                    <i class="fas fa-user"></i>
                    <a class="textoAmigos" onclick="erroAcessarPagina()">Seguindo</a>
                </div>
            </nav>

            <nav>
                <div class="Comunidade">
                    <i class="fas fa-user"></i>
                    <a class="textoComunidade" onclick="erroAcessarPagina()">Grupos</a>
                </div>
            </nav>

            <nav>
                <div class="botoesHeader botaoCadastrarHeader">
                    <form action="cad.php">
                        <input type="submit" value="Cadastrar">
                    </form>
                </div>
            </nav>

            <nav>
                <div class="botoesHeader botaoLogarHeader">
                    <form action="log.php">
                        <input type="submit" value="Logar">
                    </form>
                </div>
            </nav>
        </section>
    </div>
</header>
</body>
</html>';

echo $arqHtml;