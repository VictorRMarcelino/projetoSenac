<?php
// listar os dados salvos
$oMatriculaAtual = $_POST;
$aDadosAluno = array();

$oDados = file_get_contents("contas.json");

echo '<h1>SHIVAGO</h1><br><br>';

if($oDados){
    $aDadosAluno = json_decode($oDados);
    
    $aDadosAlunosNew = array();
    foreach ($aDadosAluno as $aluno){
        array_push($aDadosAlunosNew, $aluno);        
    }
    
    array_push($aDadosAlunosNew, $oMatriculaAtual);        
    
    file_put_contents("contas.json", json_encode($aDadosAlunosNew));
    
    $oDados = file_get_contents("contas.json");
    
    $aDadosAluno = json_decode($oDados);
     
} else{
    array_push($aDadosAluno, $oMatriculaAtual);

    file_put_contents("contas.json", json_encode($aDadosAluno));
}

echo 'Conta Criada com sucesso! <br><br>';

echo '<a href="paginaInicial.php"> Voltar</a>';









