<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as Capsule;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();
$container['db'] = function(){
    
    $capsule = new Capsule;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'slim',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;

};

$app->get('/usuarios', function(Request $request, Response $response){

    $db = $this->get('db');
    /* criar tabela */
    /*$db->schema()->dropIfExists('usuarios');
    $db->schema()->create('usuarios', function($table){

        $table->increments('id');
        $table->string('nome');
        $table->string('email');
        $table->timestamps();

    });*/

    /* inserir dados */
    /*$db->table('usuarios')->insert([
        'nome' => 'Ricardo Batel',
        'email' => 'ricardo@teste.com.br'
    ]);*/

    /* Atualizar */
    /*$db->table('usuarios')
                ->where('id', 1)
                ->update([
                    'nome' => 'Ricardo'
                ]);*/

    /* Deletar */
    /*$db->table('usuarios')
                ->where('id', 1)
                ->delete();*/

    $tabela_usuarios = $db->table('usuarios');
    $usuarios = $tabela_usuarios->get();
    foreach ($usuarios as $usuario) {
        echo $usuario->nome . '<br>';
    }

});

$app->run();

/* Tipos de respostas
cabeçalho, texto, Json, XML


$app->get('/header', function(Request $request, Response $response){

    $response->write('Esse é um retorno header');
    return $response->withHeader('allow', 'PUT')
                    ->withAddedHeader('Content-Length', 30);

});

$app->get('/json', function(Request $request, Response $response){
            
    return $response->withJson([
        "nome" => "Ricardo Batel",
        "endereco" => "Endereco tal..."
    ]);

});

$app->get('/xml', function(Request $request, Response $response){

    $xml = file_get_contents('arquivo');
    $response->write($xml);

    return $response->withHeader('Content-Type', 'application/xml');

});*/



/* Middleware 

$app->add(function($request, $response, $next){

    $response->write('Inicio camada 1 + ');
    //return $next($request, $response);
    $response = $next($request, $response);

    $response->write(' + Fim camada 1 ');
    return $response;

});

$app->add(function($request, $response, $next){

    $response->write('Inicio camada 2 + ');
    //return $next($request, $response);
    $response = $next($request, $response);

    $response->write(' + Fim camada 2 ');
    return $response;

});

/*
$app->add(function($request, $response, $next){

    $response->write('Inicio camada 2 + ');
    return $next($request, $response);

});

$app->get('/usuarios', function(Request $request, Response $response){
    
    $response->write(' Ação principal usuarios ');
    
});

$app->get('/postagens', function(Request $request, Response $response){
    
    $response->write(' Ação principal postagens ');
    
});

$

/* Container dependency injection 

class Servico {

}

/* Container Pimple 
$container = $app->getContainer();
$container['servico'] = function(){

    return new Servico;
};

$app->get('/servico', function(Request $request, Response $response){

    $servico = $this->get('servico');
    var_dump($servico);

});

/* Controllers como serviço 
$container = $app->getContainer();
$container['Home'] = function(){

    return new MyApp\controllers\Home(new MyApp\View);
};

$app->get('/usuario', 'Home:index');



/* Padrão PSR7 
$app->get('/postagens', function(Request $request, Response $response){

    /* Escrever no corpo da resposta utilizando o padrão PSR7 
    $response->getBody()->write("Lista de postagens");
    
    return $response;

});*/

/*
Tipos de requisição ou Verbos HTTP

get -> Recuperar recursos do servidor (Select)
post -> Criar dado no servidor (Insert)
put -> Atualizar dados no servidor (Update)
delete -> Deletar dados do servidor (Delete)


$app->post('/usuarios/adiciona', function(Request $request, Response $response){

    //Recupera post ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];

    /*
    Salvar no banco de dados com INSERT INTO
    .....
    

    return $response->getBody()->write("Sucesso");
});

$app->put('/usuarios/atualiza', function(Request $request, Response $response){

    //Recupera post ($_POST)
    $post = $request->getParsedBody();
    $id = $post['id'];
    $nome = $post['nome'];
    $email = $post['email'];

    /*
    Salvar no banco de dados com UPDATE
    .....
    

    return $response->getBody()->write("sucesso ao atualizar");
});

$app->delete('/usuarios/remove/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    /*
    Deletar do banco de dados com DELETE
    .....
   

    return $response->getBody()->write("sucesso ao deletar: " . $id);
});

*/


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