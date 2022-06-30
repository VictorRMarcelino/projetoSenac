<?php

require_once ("core/Query.php");

$oQuery = new Query();

$sql = " select usuario.nome,
                usuario.email,
                usuario.senha,
                usuario.sexo,
                amigos.listaamigos
          from public.amigos
    inner join usuario on (usuario.id = amigos.usuario)";

$oDadosAmigos = $oQuery->selectAll($sql);

//echo '<pre>' . print_r($oDadosAmigos, true) . '</pre>';

$html = '<table border="2">
            <thead>
                <tr>
                    <td colspan="6" style="text-align:center;">Usuário</td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>E-mail</td>
                    <td>Senha</td>
                    <td>Sexo</td>
                    <td>Amigos</td>
                </tr>
            </thead>';

foreach($oDadosAmigos as $aDadosAmigo){  
    // INICIA A LINHA 
    $html .= '<tr>';  
    $html .= '<td>' . $aDadosAmigo['nome'].'</td>';
    $html .= '<td>' . $aDadosAmigo['email'].'</td>';
    $html .= '<td>' . $aDadosAmigo['senha'].'</td>';
    $html .= '<td>' . $aDadosAmigo['sexo'].'</td>';

    $aListaAmigos = json_decode($aDadosAmigo["listaamigos"]);
    
    $aListaAmigos = json_decode($aDadosAmigo["listaamigos"]);

    $lista_meus_amigos = array();
    foreach($aListaAmigos as $id_usuario_amigo){
        $oDadosAmigo = $oQuery->select("select nome from usuario where id=$id_usuario_amigo");
        array_push($lista_meus_amigos, $oDadosAmigo["nome"]);
    }

    $html .= '<td>' . implode(",", $lista_meus_amigos) . '</td>';

    // FECHA A LINHA 
    $html .= '</tr>';      
}

$html .= '</table>';

echo $html;