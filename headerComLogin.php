<?php

$html = '<!DOCTYPE html>
<html>

<head>
    <title>GWV</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/headerComLogin.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="js/scriptErroAcessarPagina.js"></script>
</head>

<body>
<header>
        <div class="banner">
            <div class="titulo">
                <a href="paginaInicial.php">GWV</a>
            </div>

            <div class="Amigos">
                <i class="fas fa-user"></i>
                <a class="textoAmigos" onclick="paginaEmDesenvolvimento()">Seguindo</a>
            </div>

        <div class="Comunidade">
            <i class="fas fa-user"></i>
            <a class="textoComunidade" onclick="paginaEmDesenvolvimento()">Grupos</a>
        </div>

        <div class="pesquisarUsuario">
            <form action="pesquisarUsuario.php" method="post">
            <input class="pesquisarUsuario" type="text" placeholder="Pesquise usuários aqui" id="nomePesquisa" name="nomePesquisa">
            <input class="pesquisarUsuario" type="submit" value="Pesquisar">
            </form>
        </div>

        <div class="BemVindo">
                <label>Bem-Vindo:</label>
                <a href="profile.php">'. $_SESSION["usuario_nome"] .'</a>
        </div>
    <nav>
    <div class="botoes dropDownMenu">
        <input type="submit" value="Opções">
        <div class="dropDownMenuItens">
            <form action="deslogar.php">
                <input class="deslogarButton" type="submit" value="Deslogar">
            </form>
            <form action="problemas.php">
                <input class="problemasButton" type="submit" value="Problemas">
            </form>
            <form action="deletarConta.php">
                <input class="problemasButton" type="submit" value="Excluir">
            </form>
        </div>
    </div>
    </nav>
    </div>
    </header>
</body>
</html>';

echo $html;