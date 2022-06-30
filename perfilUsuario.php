<?php
session_start();

if(!isset($_SESSION["usuario_nome"])){
    
    header("location:log.php");

    die();

    return;
}else{

require_once("core/Query.php");
$oQuery = new Query();

$idUser;

    if(!empty($_POST['iduser'])){
        $idUser = $_POST['iduser'];
    }

    if(empty($idUser)){
        $idUser = $_GET["usuario"];
    }

$aDadosUsuario = $oQuery->select("select * from usuario where id = ' $idUser '");

$sessionUsuarioID = $aDadosUsuario["id"];

$res= pg_query("select * from publicacoes where usuario = '$sessionUsuarioID'");
$numpub=pg_num_rows($res);

$sobreMim = $oQuery->select("select * from usuario where id = '$sessionUsuarioID'");

$sobreMimTexto = ucfirst($sobreMim["sobremim"]);

if(empty($sobreMimTexto)){
    $sobreMimTexto = "";
}

if (!isset($_SESSION)) {
    session_start();
}

$user = $aDadosUsuario["nome"];

if($user != $_SESSION["usuario_nome"]){
function getHtmlListaPublicacao($publicacaoUsuario){
    require_once("core/Utils.php");

    $aData = explode(" ", $publicacaoUsuario["data_publicacao"]);
    $data_publicacao = Utils::converteData($aData[0]);

    $arqHtml= '   
        <link rel="stylesheet" href="css/publicacao.css">
        <div class="areaPublicacao">
            <div class="iconesFormularioPublicacao">
                <i class="fas fa-user fa-lg"></i>
                <div class="usuario_publicacao"> 
                    <a href="perfilUsuario.php?usuario=' . $publicacaoUsuario["usuario"] . '">' . $publicacaoUsuario["nome"] . ' </a>
                </div>
            </div>
                
            <div class="dataHoraPublicacao">
                <label>' . $data_publicacao . ' </label>
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

    $filtro;

    if(!empty($_POST['filtro'])){
        $filtro = $_POST['filtro'];
    }

    if(empty($filtro)){
        $filtro = "desc";
    }

    $idUser;

    if(!empty($_POST['iduser'])){
        $idUser = $_POST['iduser'];
    }

    if(empty($idUser)){
        $idUser = $_GET["usuario"];
    }

    $user = $idUser;

    $sql = " select publicacoes.id,
                    usuario,
                    publicacao,
                    data_publicacao,
                    tipo_publicacao,
                    usuario.nome
                    from publicacoes 
                    inner join usuario on (usuario.id = publicacoes.usuario)
                    where usuario = ' $user '
                    order by id $filtro";

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

    <link rel="stylesheet" href="css/perfilUsuario.css"> 
    <script type="text/javascript" src="js/scriptErroAcessarPagina.js"></script>   
</head>

<body>
    <div class="bannerUsuario">
            <div class="nomeUsuario">
                <label>'. $user.'</label>
            </div>

            <div class="numpublicacoes">
            <label> Publicações: '.$numpub.' </label>
            </div>

            <div class="sexoUsuario">
            <label> Sexo: '. $aDadosUsuario["sexo"].'</label>
            </div>


    <main>
            <div class="areasobremim">
                <label>Sobre mim</label>
                <textarea class="textosobremim" maxlength="275" placeholder="'. $sobreMimTexto . '" rows="4"
                    id="textosobremim" name="textosobremim" disabled="disabled"></textarea>
            </div>

            <div class="publicacoes" id="publicacoes">
            <label class="tPublic">Publicações</label>
                ' . $htmlListaPublicacoes . '
            </div>

            <div class="areafiltro">
            <form action="perfilUsuario.php" method="post">
            <input type="hidden" value="'. $idUser.'" id="iduser" name="iduser">
                        <label>Filtro</label>
                        <div class="filtro">
                        <p class="opcao">
                        <input type="radio" id="maisrecente" name="filtro" value="desc">
                        <label for="maisrecente">Mais recente</label>
                        </p>
                        <p class="opcao">
                        <input type="radio" id="maisrecente" name="filtro" value="asc">
                        <label for="maisrecente">Menos recente</label>  
                        <input class="botaofiltro" type="submit" value="Filtrar" onclick="filtro()">
                    </div>
            </form>
    </main>
</body>

</html>';

echo $arqhtml;
}else{
    require_once("profile.php");
}
}