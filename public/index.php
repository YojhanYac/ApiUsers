<?php

// Creación de una RESTFUL API o API REST con slim framework (PHP, MySql, PDO)
// DominiCode:              https://www.youtube.com/watch?v=iLRjbGC6jIs&ab_channel=DominiCode
// Slim 4 Documentation:    http://www.slimframework.com/docs/v4
// Composer:                https://getcomposer.org/download/
// Slim v4                  composer require slim/slim:"4.*"
// Slim PSR-7:              composer require slim/psr7

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
