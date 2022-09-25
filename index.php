<?php
error_reporting(0);

// mostra quais sites podem acessar a api *=todos
header('Access-Control-Allow-Origin: *'); 

//informa que os dados serão retornados em Json
header('Content-type: application/json');

//Define o horário padrão
date_default_timezone_set("America/Sao_Paulo");

//Path está definido como padrão la no arquivo .htaccess para pegar tudo que ve na URL depois da / e guardar nesse parametro
//verificando se veio alguma coisa
if(isset($_GET['path'])) { 
    $path = explode("/", $_GET['path']); //se veio, explode na "/"
} else {
    echo json_encode(['ERRO'=>"API NÃO ENCONTRADA"]); exit; //se nao veio, dá mensagem de erro e encerra o script
}

//Verificar appKey
if(isset($path[0])) { 
    $appKey = $path[0];
} else {
    echo json_encode(['ERRO'=>"APPKEY NECESSÁRIA"]); exit; 
}

//Verificar appToken
if(isset($path[1])) { 
    $appToken = $path[1];
} else {
    echo json_encode(['ERRO'=>"APPTOKEN NECESSÁRIO"]); exit; 
}

//Validar appKey e appToken
include_once "classes/db.class.php"; //incluindo a classe da conexao
$db = DB::connect(); //chama a conexao que está em classes/d.class.php
$rs = $db->prepare("SELECT appToken FROM acessoAPI WHERE appKey = '$appKey'"); //monta a consulta em mysql
$rs->execute(); //executa a consulta
$obj = $rs->fetchAll(PDO::FETCH_ASSOC); //retornar na variavel $obj(array) - FETCH_ASSOC é para dar nome aos campos
$obj = $obj[0]; $appTokenConfere = $obj['appToken'];

if($appToken) { if($appToken==$appTokenConfere) {
} else { echo json_encode(['ERRO'=>"NÃO AUTORIZADO"]); exit; }
}

if(isset($path[2])) { $api = $path[2]; } else { echo json_encode(['ERRO'=>"API NÃO ENCONTRADA"]); exit; }
if(isset($path[3])) { $acao = $path[3]; } else { echo json_encode(['ERRO'=>"PARAMETROS INSUFICIENTES"]); exit; }

//Pega o methodo que foi enviado para cá ex: Get, Post, Delete, Put(update)
$method = $_SERVER['REQUEST_METHOD'];

include_once "classes/db.class.php"; //incluindo a classe da conexao

////////// PESQUISAS NO CARDAPIO INICIO //////////

//para cardapio/consultaGeral
if($api=='cardapio'&&$acao=='consultaGeral') { include_once "api/cardapio/consultaGeral/index.php"; }

//para cardapio/consulId/Id
if($api=='cardapio'&&$acao=='consultaId') { 
    if(isset($path[4])) { 
        //Verifica se foi passado o ID
        $idCardapio = $path[4]; } else { echo json_encode(['ERRO'=>"INFORME O ID DO ITEM QUE DESEJA PESQUISAR"]); exit; }
    include_once "api/cardapio/consultaId/index.php"; }

////////// PESQUISAS NO CARDAPIO FIM //////////


////////// ALTERAÇÕES NO CARDAPIO INICIO //////////

//para cardapio/adicionarItem
if($api=='cardapio'&&$acao=='adicionarItem') { 
    include_once "api/cardapio/adicionarItem/index.php"; }

//para cardapio/alterarItem/Id
if($api=='cardapio'&&$acao=='alterarItem') {
    if(isset($path[4])) { 
        //Verifica se foi passado o ID
        $idCardapio = $path[4]; } else { echo json_encode(['ERRO'=>"INFORME O ID DO ITEM QUE DESEJA ALTERAR"]); exit; }
    include_once "api/cardapio/alterarItem/index.php"; }


////////// ALTERAÇÕES NO CARDAPIO FIM //////////
