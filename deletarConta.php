<?php
    session_start();

if(!isset($_SESSION["usuario_nome"])){
    
        header("location:log.php");
    
        die();
    
        return;
}else{

$nomeUsuario = $_SESSION["usuario_nome"];


include("headerComLogin.php");

$html = '<!DOCTYPE html>
<html>

<head>
    <title>GWV</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/deletarConta.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/scriptEsconderSenha.js"></script>
    <script type="text/javascript" src="js/scriptErroAcessarPagina.js"></script>
</head>

<body>
        <section class="logo">
            <img src="imgs/logopodreSLA2.png" alt="Teste" width="250">
        </section>
        <main>
            <div class="areaFormulario">
                <form action="deletarContaSistema.php" method="post">
                    <input id="acao" name="acao" type="hidden" value="EXECUTA_LOGIN">
                    <h1 class="tituloFormulario">Deseja realmente excluir sua conta?</h1>
                    <br>
                    <h2 class="tituloFormulario">Insira suas informações</h2>
                    <div class="iconesFormulario">
                        <i class="fas fa-user fa-lg"></i>
                    </div>
                    <input class="camposFormulario" type="text" placeholder='. $nomeUsuario . ' id="usuario"
                        name="usuario" disabled="disabled">
              
                    <div class="iconesFormulario">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                    <input class="camposFormulario" type="text" placeholder="Confirme seu email" id="email"
                        name="email">
                    
                    <div class="BotaoCadastrar">
                        <input type="submit" value="Excluir Conta" class="BotaoCadastrar">
                    </div>
                </form>
            </div>
        </main>
        <section>
            <label class="textoCanto">"Tornando o impossível possível"</label>
        </section>
</body>
</html>';

echo $html;

include("footer.php");
}
?>