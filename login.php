<?php
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];


function executaLogin()
{

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    require_once("core/Query.php");

    $oQuery = new Query();

    $mensagem = "Usuário ou senha incorretos!";

    $sql = "select * from public.usuario where nome = '$usuario' AND senha = '$senha'";

    $oDadosUsuario = $oQuery->select($sql);
    if ($oDadosUsuario) {

       if(!isset($_SESSION)){
        session_start();
       }

        $_SESSION["usuario"] = $oDadosUsuario["id"];
        $_SESSION["usuario_nome"] = $oDadosUsuario["nome"];

        header("Location: PaginaInicial.php");
    } else {
        echo "<script type='text/javascript'>alert('$mensagem');</script>";
        require_once("log.php");
    }
}

$message = "Preencha todos os campos para prosseguir com o login!";

if (isset($_POST["acao"])) {
    $acao = $_POST["acao"];
    if ($acao === "EXECUTA_LOGIN" && empty($usuario) || empty($senha))  {
        echo "<script type='text/javascript'>alert('$message');</script>";
        require_once("log.php");
    }else{
        executaLogin();
    }
}
