<?php

require 'vendor/autoload.php';

$app = new \Slim\App;

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

});

/* Nomear rotas */
$app->get('/blog/postagens/{id}', function($request, $response){
   echo "Listar postagens para um Id";
})->setName("blog");

$app->get('/meusite}', function($request, $response){

    $retorno = $this->get("router")->pathFor("blog", ["id" => "10"]);

    echo $retorno;
   
});

/* Agrupar rotas */

$app->group('/v1', function(){

    $this->get('/usuarios', function(){

        echo "Lista de usuarios";
    });
    
    $this->get('/postagens', function(){
    
        echo "Lista de postagens";
    });
    
});

$app->run();