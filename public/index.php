<?php

// Creación de una RESTFUL API o API REST con slim framework (PHP, MySql, PDO)
// https://www.youtube.com/watch?v=iLRjbGC6jIs&ab_channel=DominiCode

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require '../src/config/db.php';

$app = AppFactory::create();

$app->setBasePath("/API_Usuarios/public");

require '../src/rutas/clientes.php';

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello world! $name");
    return $response;
});

$app->run();
