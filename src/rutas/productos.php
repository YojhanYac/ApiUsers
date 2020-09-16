<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// GET Mostrar todos los productos
$app->get('/api/productos', function (Request $request, Response $response, $args) {

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
?>