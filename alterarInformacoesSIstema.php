<?php

session_start();

verificaCamposVazio();

function verificaCamposVazio(){
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $textoSobreMim = $_POST["textosobremim"];

    if (empty($usuario) || empty($senha) || empty($email) || empty($sexo) || empty($textoSobreMim)) {
        $alerta = "Preencha todos os campos para prosseguir!";
        echo "<script type='text/javascript'>alert('$alerta');</script>";
        require_once("alterarInformacoes.php");
    } else {
        executaVerificacaoUsuario();
    }
}

function executaVerificacaoUsuario(){
    $usuario = $_POST["usuario"];

    require_once("core/Query.php");
    $oQuery = new Query();

    $sql_select = "SELECT nome FROM usuario WHERE nome = '$usuario'";

    $nameUser = $oQuery->select($sql_select);

    if ($nameUser) {
        $alerta = "Este nome de usuário já está em uso! escolha outro para prosseguir";
        echo "<script type='text/javascript'>alert('$alerta');</script>";
        require_once("alterarInformacoes.php");
    } else {
        executaUpdate();
    }
}

function executaUpdate(){
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $textoSobreMim = $_POST["textosobremim"];

    $userName = $_SESSION["usuario_nome"];

    require_once("core/Query.php");
    $oQuery = new Query();

    $sql_update = "UPDATE usuario SET nome = '$usuario',
     senha = '$senha',
     email = '$email',
     sexo = '$sexo',
     sobremim = '$textoSobreMim'
     where nome = '$userName'";

    $oQuery->executaQuery($sql_update);

    $alerta = "Suas informações foram atualizadas com sucesso!";
    echo "<script type='text/javascript'>alert('$alerta');</script>";
    require_once("deslogar.php");
}