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
        echo '{"error" : {"text":' . $e->getMessage() . '}}';
    }
    $response->getBody()->write($var);
    return $response;
});

// POST Agregar un cliente
$app->post('/api/clientes/nuevo', function (Request $request, Response $response, $args) {
    // $parameters = $request->getBody();
    $valores = json_decode($request->getBody(), true);
    // echo $valores["name"];
    $name = $valores["name"];
    $email = $valores["email"];
    $password = $valores["password"];
    // $body = $request->getBody();

    // echo $body;

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
        echo '{"error" : {"text":' . $e->getMessage() . '}}';
    }
    $response->getBody()->write($var);
    return $response;
});


