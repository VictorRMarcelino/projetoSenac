<?php

include("headerSemLogin.php");

$arqhtml = '<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <title>GWV</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastrar.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/scriptEsconderSenha.js"></script>
    <script src="js/scriptErroAcessarPagina.js"></script>
</head>

<body onload="inicio()">
    <div class="telaFundo">
        <section class="logo">
            <img src="imgs/logopodreSLA2.png" alt="Teste" width="250">
        </section>
        <main>
        <form action="Cadastrar.php" method="post">
        <input id="acao" name="acao" type="hidden" value="EXECUTA_INCLUSAO">
        <div class="areaFormulario">
            <h1 class="tituloFormulario">Insira suas informações</h1>
            <div class="formulario">
                <div class="iconesFormulario">
                    <i class="fas fa-user fa-lg"></i>
                </div>
                <input class="camposFormulario" type="text" placeholder="Usuário" id="usuario" name="usuario">
                <div class="iconesFormulario">
                    <i class="fas fa-lock fa-lg"></i>
                </div>
                <input class="camposFormulario" type="text" placeholder="Senha" id="senha" name="senha">
                <input type="checkbox" checked="checked" id="checkbox" name="checkbox" onclick="inicio()"
                    class="checkbox">
                <label id="Tcheckbox" class="textoCheckbox">Esconder Senha</label>
                <div class="iconesFormulario">
                    <i class="fas fa-envelope fa-lg"></i>
                </div>
                <input class="camposFormulario" type="text" placeholder="Email" id="email" name="email">
                <div>
                    <div class="iconesFormulario">
                        <i class="fas fa-venus-mars fa-lg"></i>
                    </div>
                    <select class="camposFormulario" for="sexo" id="sexo" name="sexo">
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                </div>
            </div>
                <div class="BotaoCadastrar">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
                <div class="nav">
                    <label> Já possui uma conta?</label>
                    <a href="log.php"> Clique Aqui!</a>
                </div>
        </div>
    </main>
    <section>
        <label class="textoCanto">"Tornando o mundo cada vez mais unido"</label>
    </section>
    </div>
</body>

</html>';

echo $arqhtml;

include("footer.php");