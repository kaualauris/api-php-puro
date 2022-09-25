<?php
//primeiro verifica a API(url), depois o metodo, e ai começa o codigo
if($api=="cardapio") {
    if($acao=="consultaGeral") {
    if($method=="GET") {
        $db = DB::connect(); //chama a conexao que está em classes/d.class.php
        $rs = $db->prepare("SELECT * FROM cardapio"); //monta a consulta em mysql
        $rs->execute(); //executa a consulta
        $obj = $rs->fetchAll(PDO::FETCH_ASSOC); //retornar na variavel $obj(array) - FETCH_ASSOC é para dar nome aos campos

        //se existir $obj (tiver dados dentro)
        if($obj) {
            echo json_encode(["dados"=>$obj]);
        } else {
            echo json_encode(["dados"=>'Não existe dados para retornar']);
        }

    } } else { 
        echo json_encode(['ERRO'=>"Ação $acao, não existe para API $api"]); } 
} else {
    echo  json_encode(['ERRO'=>"API $api não existe"]);
}