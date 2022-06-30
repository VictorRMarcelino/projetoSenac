<?php
$emailUsuario = $_POST["email"];


executaVerificacaoEmail();

function executaVerificacaoEmail(){
    require_once("core/Query.php");
    $oQuery = new Query();

    $emailUsuario = $_POST["email"];
    $alertaErro = "Não foi possível encontrar este email em nosso banco de dados!";

    $sql = "select email from public.usuario where email = '$emailUsuario';";

    $oDados = $oQuery->select($sql);

    if($oDados){
        executaResgateSenha();
    }else{
       echo "<script type='text/javascript'>alert('$alertaErro');</script>";
       require_once("esqueceuconta.php");
    }

}

function executaResgateSenha(){
    require_once("core/Query.php");
    $oQuery = new Query();

    $emailUsuario = $_POST["email"];

    $sql = "select senha from public.usuario where email = '$emailUsuario';";

    $oDados = $oQuery->select($sql);

    $string = implode(" ",$oDados); 

    $mensagemSenha = 'Sua senha é: ' . $string;


    echo "<script type='text/javascript'>alert('$mensagemSenha');</script>";
    require_once("log.php");
}



?>