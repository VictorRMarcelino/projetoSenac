<?php

function deletaPublicacao(){
$publicID = $_POST["publicID"];

require_once("core/Query.php");

$oQuery = new Query();

$sql_delete = "delete from publicacoes where id = '$publicID'";

$oQuery->executaQuery($sql_delete);

header("Location:profile.php");
}

deletaPublicacao();