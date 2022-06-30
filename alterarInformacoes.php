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
                <label>- <label>' . $data_publicacao . '
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

    if(empty($filtro)){
        $filtro = "desc";
    }else{
    $filtro = $_POST["maisrecente"];
    }

    $user = $_SESSION["usuario"];

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

    <link rel="stylesheet" href="css/alterarInformacoes.css">
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
            <div class="publicacoes" id="publicacoes">
                <form action="alterarInformacoesSistema.php" method="post">
                    <div class="areaFormulario">
                        <h1 class="tituloFormulario">Insira suas informações</h1>
                        <div class="formulario">
                            <div class="iconesFormulario">
                                <i class="fas fa-user fa-lg"></i>
                            </div>
                            <input class="camposFormulario" type="text" placeholder="Usuário" id="usuario"
                                name="usuario">
                            <div class="iconesFormulario">
                                <i class="fas fa-lock fa-lg"></i>
                            </div>
                            <input class="camposFormulario" type="text" placeholder="Senha" id="senha" name="senha">
                            <div class="iconesFormulario">
                                <i class="fas fa-envelope fa-lg"></i>
                            </div>
                            <input class="camposFormulario" type="text" placeholder="Email" id="email" name="email">
                            <div>
                                <div class="iconesFormulario">
                                    <i class="fas fa-venus-mars fa-lg"></i>
                                </div>
                                <select class="camposFormulario" for="sexo" id="sexo" name="sexo">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                            <div>
                                <label class="tituloSobreMim">Sobre mim</label>
                                <textarea class="textosobremim" maxlength="275" rows="5" 
                                 id="textosobremim" name="textosobremim"></textarea>
                            </div>
                        </div>
                        <div class="botaoSalvar">
                            <input type="submit" value="Salvar">
                        </div>
                </form>
            </div>
    </div>
    </main>
    </div>
</body>

</html>';

echo $arqhtml;
}