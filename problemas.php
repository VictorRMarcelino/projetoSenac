<?php

session_start();

if(isset($_SESSION["usuario"])){

include("headerComLogin.php");

$arqhtml = '<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>GWV</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/problemas.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script type="text/javascript" src="js/scriptErroAcessarPagina.js"></script>
    </head>
    <body>
    <section class="logo">
            <img src="imgs/logopodreSLA2.png" alt="Teste" width="250">
    </section>
    <form action="problemasSistema.php" method="post">
        <div class="areaFormulario">
            <Label class="tituloFormulario">Insira suas informações</label>
            <div class="iconesFormulario">
                <i class="fas fa-envelope fa-lg"></i>
            </div>
            <input class="camposFormulario" type="text" placeholder="email@email.com" id="Email" name="Email">
            <div class="iconesFormulario">
                <i class="fas fa-file fa-lg"></i>
            </div>
            
            <select class="camposFormulario" id="tipoReclamacao" name="tipoReclamacao">
                <option value="Página não carrega">Página não carrega</option>
                <option value="Botão não funciona">Botão não funciona</option>
                <option value="Postagens inadequadas">Postagens inadequadas</option>
            </select>            
            
            <div class="iconesFormulario">
                <i class="fas fa-pen fa-lg"></i>
            </div>
            
            <textarea class="areaObservacoes" maxlength="275" placeholder="Descreve aqui seu problema" rows="4" id="areaObservacoes"
            name="areaObservacoes" value="Problema de testes"></textarea>
            <div class="BotaoEnviar">
                <input type="submit" value="Enviar ticket" class="BotaoCadastrar">
            </div>
        </div>
    </form>
    <section>
            <label class="textoCanto">"Tornando o impossível possível"</label>
        </section>
    <footer>
        <div class="rodape">
            <a>Contato: (47) 4002-8922</a>
            <a></a>
            <a></a>
            <a href="problemas.php">Relatar Problema</a>
        </div>
    </footer>
    </body>
</html>';
echo $arqhtml;

}else{
include("headerSemLogin.php");
$arqhtml = '<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>GWV</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/problemasSemLogin.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script type="text/javascript" src="js/scriptErroAcessarPagina.js"></script>
    </head>
    <body>
<section class="logo">
            <img src="imgs/logopodreSLA2.png" alt="Teste" width="250">
    </section>
    <form action="problemasSistema.php" method="post">
        <div class="areaFormulario">
            <Label class="tituloFormulario">Insira suas informações</label>
            <div class="iconesFormulario">
                <i class="fas fa-envelope fa-lg"></i>
            </div>
            <input class="camposFormulario" type="text" placeholder="Email" id="Email" name="Email">
            <div class="iconesFormulario">
                <i class="fas fa-file fa-lg"></i>
            </div>
            <select class="camposFormulario" id="tipoReclamacao" name="tipoReclamacao">
                <option value="Página não carrega">Página não carrega</option>
                <option value="Botão não funciona">Botão não funciona</option>
                <option value="Postagens inadequadas">Postagens inadequadas</option>
            </select>
            <div class="iconesFormulario">
                <i class="fas fa-pen fa-lg"></i>
            </div>
            <textarea class="areaObservacoes" maxlength="275"
            placeholder="Descreve aqui seu problema" rows="4" id="areaObservacoes"
            name="areaObservacoes"></textarea>
            <div class="BotaoEnviar">
                <input type="submit" value="Enviar ticket" class="BotaoCadastrar">
            </div>
        </div>
    </form>
    </body>
</html>';

echo $arqhtml;
}
include("footer.php");
