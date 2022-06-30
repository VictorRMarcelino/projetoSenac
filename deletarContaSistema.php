<?php

//Inicia sessão - FUNCIONANDO
if(!isset($_SESSION)){
    session_start();
}

verificaCampoEmail();

//Verifica se o campo EMAIL está preenchido - FUNCIONANDO
function verificaCampoEmail(){
    $email = $_POST["email"];

    if(empty($email)){
        $alertaErroEmail = "O campo EMAIL está vazio! preencha para prosseguir!";
        echo "<script type='text/javascript'>alert('$alertaErroEmail');</script>";
        require_once("deletarConta.php");
    } else {
        verificaInformacoes();
    }
}


//Verifica se as informações fornecidas estão presentes no banco de dados - FUNCIONA ENTRE ASPAS
function verificaInformacoes(){
    $email = $_POST["email"];

    require_once("core/Query.php");
    $oQuery = new Query();

    $sql_select = "select * from public.usuario where email = '$email'";

    $oDados = $oQuery->select($sql_select);

    if($oDados){
        executaExclusaoPublicacoes();
    } else {
        $alertaErroVerificacao = "Não foi possível encontrar uma conta com esses dados!";
        echo "<script type='text/javascript'>alert('$alertaErroVerificacao');</script>";
        require_once("deletarConta.php");
    }
}

function executaExclusaoPublicacoes(){
    require_once("core/Query.php");
    $oQuery = new Query();

    $sessionId = $_SESSION["usuario"];

    $sql_delete = " select * from publicacoes where usuario = '$sessionId'";

    $oDado = $oQuery->select($sql_delete);

    if($oDado){
    $sql_delete = "delete from publicacoes where usuario = '$sessionId'";
    $oQuery->executaQuery($sql_delete);
    executaExclusaoConta();
    }else{
        executaExclusaoConta(); 
    }
}

function executaExclusaoConta(){
    require_once("core/Query.php");
    $oQuery = new Query();

    $email = $_POST["email"];

    $sql_deleteUser = " delete from usuario where email = '$email'";

    $oQuery->executaQuery($sql_deleteUser);

    $alertaSucessoExclusao = "Sua conta foi excluida com sucesso!";
    
    echo "<script type='text/javascript'>alert('$alertaSucessoExclusao');</script>";
    
    // CHAMA O DESLOGAR E redireciona para login
    if(isset($_SESSION)){
        session_destroy();
    }

    header("location:log.php");
}