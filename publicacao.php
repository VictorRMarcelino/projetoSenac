<?php
if(!isset($_SESSION)){
    session_start();
}

executaVerificacaoCampoVazio();

function executaVerificacaoCampoVazio(){
    $mensagem = $_POST["textoPublic"];
    $erroCampoVazio = "O campo de publicação está vazio! preencha para poder publicar";

    if(empty($mensagem)){
        echo "<script type='text/javascript'>alert('$erroCampoVazio');</script>";
        require_once("paginaInicial.php");
    } else {
        publicacaoGeral();
    }
}

function publicacaoGeral(){
    require_once("core/Query.php");
    $oQuery = new Query();

    $select = $_POST["visualizacaoS"];
    
    $user = $_SESSION["usuario"];

    $mensagem = $_POST["textoPublic"];

    $select = $_POST["visualizacaoS"];

    $data_publicacao = date("Y-m-d");

    $sql_insert = "INSERT INTO public.publicacoes (usuario, publicacao, tipo_publicacao, data_publicacao)
    VALUES('$user', '$mensagem', '$select', '$data_publicacao');";

    $oQuery->executaQuery($sql_insert);


    if($select == "Comunidade"){
        require_once("paginaInicial.php");
    }else
        require_once("profile.php");
    }
?>