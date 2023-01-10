<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

/* Padrão PSR7 */
$app->get('/postagens', function(Request $request, Response $response){

    /* Escrever no corpo da resposta utilizando o padrão PSR7 */
    $response->getBody()->write("Lista de postagens");
    
    return $response;

});

/*
Tipos de requisição ou Verbos HTTP

get -> Recuperar recursos do servidor (Select)
post -> Criar dado no servidor (Insert)
put -> Atualizar dados no servidor (Update)
delete -> Deletar dados do servidor (Delete)
*/

$app->post('/usuarios/adiciona', function(Request $request, Response $response){

    //Recupera post ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];

    return $response->getBody()->write($nome . ' - ' . $email);
});

$app->run();

/*
$app->get('/postagens2', function(){

    echo "Lista de postagens";
});

$app->get('/usuarios[/{id}]', function($request, $response){
    $id = $request->getAttribute('id');

    //verificar se ID é valido e xiste no BD

    echo "Lista de usuarios ou ID: ".$id;
});

$app->get('/postagens[/{ano}[/{mes}]]', function($request, $response){
    $ano = $request->getAttribute('ano');
    $mes = $request->getAttribute('mes');

    //verificar se ID é valido e xiste no BD

    echo "Lista de postagens Ano: ".$ano." mes: ".$mes;
});

$app->get('/lista/{itens:.*}', function($request, $response){

    $itens = $request->getAttribute('itens');
    
    //verificar se ID é valido e xiste no BD

    var_dump(explode("/", $itens));

});*/

/* Nomear rotas 
$app->get('/blog/postagens/{id}', function($request, $response){
   echo "Listar postagens para um Id";
})->setName("blog");

$app->get('/meusite}', function($request, $response){

    $retorno = $this->get("router")->pathFor("blog", ["id" => "10"]);

    echo $retorno;
   
});*/

/* Agrupar rotas 

$app->group('/v1', function(){

    $this->get('/usuarios', function(){

        echo "Lista de usuarios";
    });
    
    $this->get('/postagens', function(){
    
        echo "Lista de postagens";
    });
    
});

$app->run();*/