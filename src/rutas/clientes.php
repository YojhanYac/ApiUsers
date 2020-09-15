<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// GET Mostrar todos los clientes
$app->get('/api/clientes', function (Request $request, Response $response, $args) {

    $sql = "SELECT * FROM clientes";

    try {
        $db = new Database();
        $db = $db->connectDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0) {
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            $var = json_encode($clientes);
        } else{
            $var = json_encode("No existen clientes en la BBDD");
        }

        $resultado = null;
        $db = null;

    } catch(PDOException $e) {
        $var = '{"error" : {"text":' . $e->getMessage() . '}}';
    }
    $response->getBody()->write($var);
    return $response;
});

// GET Mostrar un cliente
$app->get('/api/clientes/{id}', function (Request $request, Response $response, $args) {

    $id_cliente = $args['id'];

    $sql = "SELECT * FROM clientes WHERE id = $id_cliente";

    try {
        $db = new Database();
        $db = $db->connectDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0) {
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            $var = json_encode($clientes);
        } else{
            $var = json_encode("No existe cliente con ese ID");
        }

        $resultado = null;
        $db = null;

    } catch(PDOException $e) {
        $var = '{"error" : {"text":' . $e->getMessage() . '}}';
    }
    $response->getBody()->write($var);
    return $response;
});

// POST Agregar un cliente
$app->post('/api/clientes/nuevo', function (Request $request, Response $response, $args) {

    $valores = json_decode($request->getBody(), true);
    $name = $valores["name"];
    $email = $valores["email"];
    $password = $valores["password"];

    $sql = "INSERT INTO clientes (name,email,password) VALUES (:name, :email, :password)";

    try {
        $db = new Database();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);

        $resultado->bindParam(':name', $name);
        $resultado->bindParam(':email', $email);
        $resultado->bindParam(':password', $password);
        $resultado->execute();

        $var = json_encode("Nuevo cliente guardado");

        $resultado = null;
        $db = null;

    } catch(PDOException $e) {
        $var = '{"error" : {"text":' . $e->getMessage() . '}}';
    }
    $response->getBody()->write($var);
    return $response;
});

// PUT Modificar cliente
$app->put('/api/clientes/modificar/{id}', function (Request $request, Response $response, $args) {

    $valores = json_decode($request->getBody(), true);

    $name = $valores["name"];
    $email = $valores["email"];
    $password = $valores["password"];
    $id_cliente = $args['id'];

    $sql = "UPDATE clientes SET name = :name, email = :email, password = :password WHERE id = $id_cliente";

    try {
        $db = new Database();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);

        $resultado->bindParam(':name', $name);
        $resultado->bindParam(':email', $email);
        $resultado->bindParam(':password', $password);
        $resultado->execute();

        $var = json_encode("Cliente modificado");

        $resultado = null;
        $db = null;

    } catch(PDOException $e) {
        $var = '{"error" : {"text":' . $e->getMessage() . '}}';
    }
    $response->getBody()->write($var);
    return $response;
});

// DELETE Borrar cliente
$app->delete('/api/clientes/delete/{id}', function (Request $request, Response $response, $args) {

    $id_cliente = $args['id'];

    $sql = "DELETE FROM clientes WHERE id = $id_cliente";

    try {
        $db = new Database();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();

        if($resultado->rowCount() > 0) {
            $var = json_encode("Cliente eliminado");
        } else{
            $var = json_encode("No existe cliente con ese ID");
        }

        $resultado = null;
        $db = null;

    } catch(PDOException $e) {
        $var = '{"error" : {"text":' . $e->getMessage() . '}}';
    }
    $response->getBody()->write($var);
    return $response;
});

