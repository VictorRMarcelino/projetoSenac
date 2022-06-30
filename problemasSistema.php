<?php

executaVerificacaoCampoEmail();

//executa verificação para saber se o campo "email" está vazio ou não
function executaVerificacaoCampoEmail(){
     $email = $_POST["Email"];
     $alertaErroEmail = "O campo EMAIL está vazio! preencha para prosseguir!";  

     if(empty($email)){
       echo "<script type='text/javascript'>alert('$alertaErroEmail');</script>";

       require_once("problemas.php");
     } else {
        executaVerificacaoCampoDetalhes();
     }
}

//executa verificação para saber se o campo "detalhes" está vazio ou não
function executaVerificacaoCampoDetalhes(){
    $detalhes = $_POST["areaObservacoes"];

    if(empty($detalhes)){
       $alertaErroDetalhes = "O campo DETALHES está vazio! preencha para prosseguir!";
       echo "<script type='text/javascript'>alert('$alertaErroDetalhes');</script>";

       require_once("problemas.php");
    } else {
        executaInsert();
    }
}

//executa insert da reclamação no banco de dados
function executaInsert(){
    $email = $_POST["Email"];
    $detalhes = $_POST["areaObservacoes"];
    $tipoReclamacao = $_POST["tipoReclamacao"];

    require_once("core/Query.php");
    $oQuery = new Query();

    $sql_insert = "INSERT INTO public.reclamacoes (email, tipoReclamacao, reclamacao) 
    values ('$email', '$tipoReclamacao', '$detalhes');";

    $oQuery->executaQuery($sql_insert);

    $alertaSucesso = "Sua reclamação foi recebida com sucesso!";

    $alertaSucesso2 = "Fique atento ao seu email, iremos responde-lo nas próximas 24 horas!";

    echo "<script type='text/javascript'>alert('$alertaSucesso');</script>";
    echo "<script type='text/javascript'>alert('$alertaSucesso2');</script>";

    require_once("problemas.php");
}
?>