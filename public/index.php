<?php

// Creación de una RESTFUL API o API REST con slim framework (PHP, MySql, PDO)
// POSTMAN, XAMP, MySQL Workbench, GIT Bash
// https://petstore.swagger.io/#/pet

// DominiCode:                          https://www.youtube.com/watch?v=iLRjbGC6jIs&ab_channel=DominiCode
// Slim 4 Documentation:                http://www.slimframework.com/docs/v4
// Composer:                            https://getcomposer.org/download/
// Slim v4                              composer require slim/slim:"4.*"
// Slim PSR-7:                          composer require slim/psr7

// API URLs:
// GET Mostrar clientes:                http://localhost/API_Usuarios/public/api/clientes

// GET Mostrar cliente por id:          http://localhost/API_Usuarios/public/api/clientes/{id}

/* POST Agregar cliente nuevo:          http://localhost/API_Usuarios/public/api/clientes/nuevo
    Headers: KEY: Content-Type  VALUE: application/json
        Body: row JSON  {
                            "name": "NOMBRE",
                            "email": "CORREO@MAIL.COM",
                            "password": "CONTRASEÑA"
                        }
*/

/* PUT Modificar cliente por id:        http://localhost/API_Usuarios/public/api/clientes/modificar/{id} 
    Headers: KEY: Content-Type  VALUE: application/json
        Body: row JSON  {
                            "name": "NUEVO_NOMBRE",
                            "email": "NUEVO_CORREO@MAIL.COM",
                            "password": "NUEVA_CONTRASEÑA"
                        }
*/

// DELETE Eliminar cliente por id:      http://localhost/API_Usuarios/public/api/clientes/delete/{id}

/*
    CREATE DATABASE db_apiusers;
    USE db_apiusers;
    CREATE TABLE Clientes(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(70) NOT NULL,
        password VARCHAR(46) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
        token VARCHAR(64) DEFAULT NULL,
        expired_token DATETIME NULL
    );
*/

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
