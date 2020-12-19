<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

require_once __DIR__ . "/../vendor/autoload.php";

$caminho = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : header("Location: /listar-cursos", true, 302);

$routes = require_once __DIR__ . "/../config/routes.php";

if (!array_key_exists($caminho, $routes)) {
    http_response_code(404);
    die();
}

session_start();

$ehRotaLogin = stripos($caminho, "login");
if (!isset($_SESSION['logado']) && $ehRotaLogin === false) {
    header("Location: /login");
    exit();
}

if (isset($_SESSION['logado']) && $ehRotaLogin > 0) {
    header("Location: /listar-cursos");
    exit();
}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$container = require __DIR__ . '/../config/dependecies.php';
$serverRequest = $creator->fromGlobals();

$controller = $container->get($routes[$caminho]);
$response = $controller->handle($serverRequest);

foreach ($response->getHeaders() as $key => $values) {
    foreach ($values as $value) {
        header($value);
    }
}


echo $response->getBody();

