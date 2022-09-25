<?php

if($idCardapio=='') { echo json_encode(['ERRO'=>"ID DO ITEM NÃO PODE SER VAZIO"]); exit; }  {

if($method=="POST") {
    $sql = "UPDATE cardapio SET ";
    
    $contador=1;
    //varre o array com os indices(nomes dos inputs do formulario) juntando(com .=) os resultados na variavel $sql
    foreach(array_keys($_POST) as $indice) {
        //conut($_POST) vai contar qts itens tem no array -> isso pra saber que no ultimo item não vai virgula na frente
        if(count($_POST) > $contador) {
            $sql.="`{$indice}` = '{$_POST[$indice]}', ";
        } else {
            $sql.="`{$indice}` = '{$_POST[$indice]}' ";
        }
        $contador++;
    }
    $sql.="WHERE id='$idCardapio'";

    //incluindo no DB
    $db = DB::connect(); //chama a conexao que está em classes/d.class.php
    $rs = $db->prepare($sql); //monta a consulta em mysql com a variavel criada com os valores dos arrays de indices e valores
    $execucao = $rs->execute(); //executa a consulta
   
    //Verificando se deu certo
    if($execucao) {
        echo  json_encode(['dados'=>"Dados atualizados com sucesso"]); exit;
    } else {
        echo  json_encode(['dados'=>"Erro, dados não foram atualizados"]); exit;
    }
} else {
    echo  json_encode(['ERRO'=>"METODO $method INVÁLIDO, NECESSÁRIO UTILIZAR PUT"]); exit;
}

}
