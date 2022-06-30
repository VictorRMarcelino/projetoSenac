<?php

if(isset($_SESSION)){
    session_destroy();
}

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
$email = $_POST["email"];
$sexo = $_POST["sexo"];


$alerta = "Preencha todos os campos para prosseguir com o cadastro!";

if (isset($_POST["acao"])) {
    $acao = $_POST["acao"];
    if ($acao === "EXECUTA_INCLUSAO" && empty($usuario) || empty($senha) || empty($email)) {
        echo "<script type='text/javascript'>alert('$alerta');</script>";
        require_once("cad.php");
    } else {
        executaVerificacaoUsuario();
    }
}

function executaVerificacaoUsuario()
{
    $usuario = $_POST["usuario"];
    require_once("core/Query.php");

    $oQuery = new Query();


    $mensagem = "Este nome de usuário já está em uso! escolha outro para prosseguir";

    $sql = "select * from public.usuario where nome = '$usuario'";

    $oDadosUsuario = $oQuery->select($sql);
    if ($oDadosUsuario) {
        echo "<script type='text/javascript'>alert('$mensagem');</script>";
        require_once("cad.php");
    } else {
        executaVerificacaoEmail();
    }
}

function executaVerificacaoEmail(){
    
    $email = $_POST["email"];
    require_once("core/Query.php");

    $oQuery = new Query();


    $mensagem = "Este email já está em uso! escolha outro para prosseguir";

    $sql = "select * from public.usuario where email = '$email'";

    $oDadosUsuario = $oQuery->select($sql);
    if ($oDadosUsuario) {
        echo "<script type='text/javascript'>alert('$mensagem');</script>";
        require_once("cad.php");
    } else {
        executaInclusao();
    }
}

function executaInclusao()
{
    require_once("core/Query.php");
    $oQuery = new Query();

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];

    $sql_insert = "INSERT INTO public.usuario (nome, senha, email, sexo)
        VALUES('$usuario', '$senha', '$email', '$sexo');";

    $oQuery->executaQuery($sql_insert);

    require_once("log.php");
}

