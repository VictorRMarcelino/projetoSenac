<?php

salverSobreMim();

function salverSobreMim(){
    require_once("core/Query.php");
    $oQuery = new Query();

    session_start();
    $textoSobreMim = $_POST["textosobremim"];
    $sessionUsuario = $_SESSION["usuario_nome"];

    $sql = "UPDATE usuario SET sobremim = '$textoSobreMim' WHERE nome = '$sessionUsuario'";
    $oQuery->executaQuery($sql);

    $mensagem = "Sua descrição foi alterada com sucesso";
    echo "<script type='text/javascript'>alert($mensagem);</script>";
    require_once("profile.php");
}