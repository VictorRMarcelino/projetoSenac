<?php

session_start();

if(isset($_SESSION["usuario_nome"])){
    // SE ESTIVER LOGADO, REDIRECIONA PARA A PAGINA PRINCIPAL

    header("location:paginaInicial.php");

    die();

    return;
}else{

include("headerSemLogin.php");

$arqHtml= '<!DOCTYPE html>
<html>
    <head>
        <title>GWV</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/logCSS.css">
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
            <div class="areaFormulario">
                <form action="login.php" method="post">
                <input id="acao" name="acao" type="hidden" value="EXECUTA_LOGIN">
                <h1 class="tituloFormulario">Insira suas informações</h1>
                <div class="iconesFormulario">
                    <i class="fas fa-user fa-lg"></i>
                </div>
                <input class="camposFormulario" type="text" placeholder="Usuário" id="usuario" name="usuario">
                <div class="iconesFormulario">
                    <i class="fas fa-lock fa-lg"></i>
                </div>

                <input class="camposFormulario" type="text" placeholder="Senha" id="senha" name="senha">
                
                <input type="checkbox" class="checkbox" id="checkbox" name="checkbox" checked="checked" onclick="inicio()">

                <label id="Tcheckbox" class="textoCheckbox">Esconder Senha</label>
                <div class="BotaoCadastrar">
                    <input type="submit" value="Logar" class="BotaoCadastrar">
                </div>
            </form>
                <div class="nav">
                    <label> Ainda não possui uma conta?</label>
                    <a href="cad.php"> Clique Aqui!</a>
                </div>

                <div class="nav nav2">
                    <label> Esqueceu seu login/senha?</label>
                    <a href="EsqueceuConta.php"> Clique Aqui!</a>
                </div>
            </div>
        </main>
        <section>
            <label class="textoCanto">"Tornando o impossível possível"</label>
        </section>
    </div>
</body>
</html>';

echo $arqHtml;
}

include("footer.php");