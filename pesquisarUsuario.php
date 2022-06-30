<?php
session_start();

if(!isset($_SESSION["usuario_nome"])){
    // SE ESTIVER LOGADO, REDIRECIONA PARA A PAGINA PRINCIPAL

    header("location:log.php");

    die();

    return;
}else{

function getHtmlListaPublicacao($publicacaoUsuario){
    require_once("core/Utils.php");
    $arqHtml= '   
    <div class="areaResultado">
    <div class="iconesFormularioPublicacao">
        <i class="fas fa-user fa-lg"></i>
        <div class="usuario_publicacao"> 
            <a href="perfilUsuario.php?usuario=' . $publicacaoUsuario["id"] . '">' . $publicacaoUsuario["nome"] . ' </a>
        </div>
    </div>              
</div>';

    return $arqHtml;
}

function getListaPublicacoes(){
    // Buscar os dados do banco de dados
    require_once ("core/Query.php");

    /* @var $oQuery Query */
    $oQuery = new Query();

    $nome = $_POST["nomePesquisa"];

    $sql_select = " select usuario.id, nome from usuario where nome like '$nome%'";

    $aDados = $oQuery->selectAll($sql_select);

    $html = '';
    foreach ($aDados as $publicacaoUsuario){
        $html .= getHtmlListaPublicacao($publicacaoUsuario);
    }

    return $html;   
}

$htmlListaPublicacoes = getListaPublicacoes();

include("headerComLogin.php");

$arqhtml = '<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <title>GWV</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <link rel="stylesheet" href="css/pesquisarUsuario.css">
    <script type="text/javascript" src="js/scriptErroAcessarPagina.js"></script>    
</head>

<body>
    <main>
            <div class="usuarios" id="publicacoes">
            <label class="tusuarios">Resultados</label>
                ' . $htmlListaPublicacoes . '
            </div>
    </main>
</body>

</html>';

echo $arqhtml;
}
