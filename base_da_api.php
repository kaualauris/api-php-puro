<?php
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
    echo "Caminho não existe"; exit; //se nao veio, dá mensagem de erro e encerra o script
}

//ver se veio alguma informação no parametro 0, salva na variavel $api
if(isset($path[0])) { $api = $path[0]; } else { echo "Caminho não existe"; }
if(isset($path[0])) { $nome = $path[1]; } else { $nome = ""; }
if(isset($path[0])) { $descricao = $path[2]; } else { $descricao = ""; }

//Pega o methodo que foi enviado para cá ex: Get, Post, Delete, Put(update)
$method = $_SERVER['REQUEST_METHOD'];