<?php

use \Slim\App;
use Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$configuration = new \Slim\Container($configuration);

$mid01 = function(Request $request, Response $response, $next) : Response {
  $response->getBody()->write("DENTRO DO MIDDLEWARE 01<br>");
  $response = $next($request, $response);
  $response->getBody()->write("<br>DENTRO DO MIDDLEWARE 02<br>");  
  
  return $response;
};

$app = new App($configuration);

$app->group('/produtos', function() use($app) {
    $app->get('/', $callable);
    $app->get('/asd', $callable);
})->add($mid01);

$app->get('/produtos[/{nome}]', function(Request $request, Response $response, array $args) : Response {
    $limit = $request->getQueryParams()['limit'] ?? 20;
    $nome = $args['nome'] ?? 'mouse';
    
    return $response->getBody()->write("{$limit} Produtos do Banco de dados com o nome {$nome}");
    
    return $response;
});

$app->post('/produto', function(Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    
    $nome = $data['nome'] ?? '';
//    if(is_null($nome)) {
//        //EXCEPTION
//    }
    return $response->getBody()->write("Produto: {$nome} {POST}");
})->add($mid01);

$app->put('/produto', function(Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    
    $nome = $data['nome'] ?? '';
//    if(is_null($nome)) {
//        //EXCEPTION
//    }
    return $response->getBody()->write("Produto: {$nome} {PUT}");
});

$app->delete('/produto', function(Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    
    $nome = $data['nome'] ?? '';
//    if(is_null($nome)) {
//        //EXCEPTION
//    }
    return $response->getBody()->write("Produto: {$nome} {DELETE}");
});

$app->run();

