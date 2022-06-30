<?php

if (!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["usuario_nome"])){
    // SE ESTIVER LOGADO, REDIRECIONA PARA A PAGINA PRINCIPAL

    header("location:log.php");

    die();

    return;
}else{

function getHtmlListaPublicacao($publicacaoUsuario){
    require_once("core/Utils.php");

    $aData = explode(" ", $publicacaoUsuario["data_publicacao"]);
    $data_publicacao = Utils::converteData($aData[0]);

    $arqHtml= '   
        <div class="areaPublicacao">
            <div class="iconesFormularioPublicacao">
                <i class="fas fa-user fa-lg"></i>
                <div class="usuario_publicacao"> 
                    <a href="perfilUsuario.php?usuario=' . $publicacaoUsuario["usuario"] . '">' . $publicacaoUsuario["nome"] . ' </a>
                </div>
            </div>
                
            <div class="dataHoraPublicacao"><label>'. $data_publicacao .'</label>
            </div>                
                
            <div class="usuario_publicacao conteudoPublicacao">
            <textarea class="campoPublicacao"  disabled="disabled" id="senha" name="senha" placeholder="' . $publicacaoUsuario["publicacao"] . '"></textarea>
            </div>
        </div>';

    return $arqHtml;
}

function getListaPublicacoes(){
    // Buscar os dados do banco de dados
    require_once ("core/Query.php");

    /* @var $oQuery Query */
    $oQuery = new Query();

    $var = "Todos";

    $sql = " select publicacoes.id,
                    usuario,
                    publicacao,
                    data_publicacao,
                    tipo_publicacao,
                    usuario.nome
                from publicacoes 
          inner join usuario on (usuario.id = publicacoes.usuario)
          where tipo_publicacao = 'Comunidade'
          order by id desc";

    // Retorna um array de dados
    $aDados = $oQuery->selectAll($sql);

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

    <link rel="stylesheet" href="css/paginaInicial.css"> 
    <link rel="stylesheet" href="css/publicacao.css">  
    <script type="text/javascript" src="js/scriptErroAcessarPagina.js"></script>
</head>

<body>
    <section class="logo">
            <img src="imgs/logopodreSLA2.png" alt="Teste" width="250">
    </section>
    <main>
            <div class="areaPublicar">
                <form action="publicacao.php" method="post">
                    <textarea class="textoPublicacao" maxlength="275"
                        placeholder="Escreva aqui sua publicação" rows="4" id="textoPublic"
                        name="textoPublic"></textarea>
                    <label class="textTipoPublicacao">Onde será publicado?</label>
                    <select class="selectTipoPublicacao" id="visualizacaoS" name="visualizacaoS">
                        <option value="Comunidade">Comunidade</option>
                        <option value="Perfil">Perfil</option>
                    </select>
                    <input class="botaoPublicar" type="submit" value="Publicar">
                </form>
            </div>

            <div class="publicacoesComunidade" id="publicacoes">
            <label class="tituloPublicacoes">Publicações</label>
                ' . $htmlListaPublicacoes . '
            </div>
    </main>
</body>

</html>';

echo $arqhtml;
}