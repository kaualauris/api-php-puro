<?php
//primeiro verifica a API(url), depois o metodo, e ai começa o codigo
if($api=="cardapio") {
    if($acao=="consultaId") {
    if($idCardapio=='') { echo json_encode(['ERRO'=>"ID DO ITEM NÃO PODE SER VAZIO"]); exit; }  {
    if($method=="GET") {
        $db = DB::connect(); //chama a conexao que está em classes/d.class.php
        $rs = $db->prepare("SELECT * FROM cardapio WHERE id = $idCardapio"); //monta a consulta em mysql
        $rs->execute(); //executa a consulta
        $obj = $rs->fetchAll(PDO::FETCH_ASSOC); //retornar na variavel $obj(array) - FETCH_ASSOC é para dar nome aos campos

        //se existir $obj (tiver dados dentro)
        if($obj) {
            echo json_encode(["dados"=>$obj]);
        } else {
            echo json_encode(["dados"=>'ID NÃO ENCONTRADO']);
        }

    } } } else { 
        echo json_encode(['ERRO'=>"Ação $acao, não existe para API $api"]); exit; } 
} else {
    echo  json_encode(['ERRO'=>"API $api não existe"]); exit;
}