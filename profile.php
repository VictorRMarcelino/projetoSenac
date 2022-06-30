<?php
    session_start();


if(!isset($_SESSION["usuario_nome"])){
    // SE ESTIVER LOGADO, REDIRECIONA PARA A PAGINA PRINCIPAL

    header("location:log.php");

    die();

    return;
}else{

    require_once("core/Query.php");

    $oQuery = new Query();

    $sessionUsuario = $_SESSION["usuario_nome"];
    $sessionUsuarioID = $_SESSION["usuario"];

    $aDadosUsuario = $oQuery->select("select * from usuario where nome = '$sessionUsuario'");

    $res= pg_query("select * from publicacoes where usuario = '$sessionUsuarioID'");
    $numpub=pg_num_rows($res);

    $sobreMim = $oQuery->select("select * from usuario where nome = '$sessionUsuario'");

    $sobreMimTexto = ucfirst($sobreMim["sobremim"]);

    if(empty($sobreMimTexto)){
        $sobreMimTexto = "Escreva sobre você";
    }



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
                    <a href="profile.php?usuario=' . $publicacaoUsuario["usuario"] . '">' . $publicacaoUsuario["nome"] . ' </a>
                </div>
            </div>
                
            <div class="dataHoraPublicacao">
            <label>' . $data_publicacao . '</label>
            </div>                
                
            <div class="usuario_publicacao conteudoPublicacao">
            <textarea class="campoPublicacao"  disabled="disabled" id="senha" name="senha" placeholder="' . $publicacaoUsuario["publicacao"] . '"></textarea>
            </div>

            <div class="excluirPublicacao">
            <form action="profileSistema.php" method="post">
            <input type="hidden" value="'. $publicacaoUsuario["id"].'" id="publicID" name="publicID">
            <input class="botaoexcluir" type="submit" value="Excluir">
            </form>
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

    $user = $_SESSION["usuario"];

    $sql = "select publicacoes.id,
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

    <script src="js/scriptEsconderSenha.js"></script>
    <script src="js/profile.js"></script>
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>

    <div class="bannerUsuario">
        <div class="nomeUsuario">
            <label>'. $_SESSION["usuario_nome"].'</label>
        </div>
        <div class="alterarInformacoes">
            <a href="alterarInformacoes.php">Alterar Informações</a>
        </div>
        <div class="numpublicacoes">
            <label> Publicações: '.$numpub.' </label>
        </div>
        <div class="sexoUsuario">
            <label> Sexo: '. $aDadosUsuario["sexo"].'</label>
        </div>


        <main>
            <div class="areasobremim">
            <form action="sobreMim.php" method="post">
                <label>Sobre mim</label>
                <textarea class="textosobremim" maxlength="275" rows="5"
                placeholder="'. $sobreMimTexto . '"
                id="textosobremim" name="textosobremim" disabled="disabled"></textarea>
                <input class="salvarsobremim" type="submit" value="Salvar" id="Salvar" disabled="disabled">
                </form>
                <input class="editarSobreMim" type="submit" value="Editar" id="Editar" onclick="sobreMim()">
            </div>

            <div class="areafiltro">
                <form action="profile.php" method="post">
                    <label class="tFiltro">Filtro</label>
                    <div class="filtro">
                        <p class="opcao">
                            <input type="radio" id="maisrecente" name="filtro" value="desc">
                            <label for="maisrecente">Mais recente</label>
                        </p>
                        <p class="opcao">
                            <input type="radio" id="maisrecente" name="filtro" value="asc">
                            <label for="maisrecente">Menos recente</label>
                            <input class="botaofiltro" type="submit" value="Filtrar">
                    </div>
                </form>
            </div>

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

            <div class="publicacoesUser" id="publicacoesUser">
                <label class="titlePublicacoes">Suas Publicações</label>
                ' . $htmlListaPublicacoes . '
            </div>
            <input class="sizePublicacoes" type="submit" value="-" onclick="sizePublicacoes()">
        </main>
    </div>
</body>

</html>';

echo $arqhtml;
}