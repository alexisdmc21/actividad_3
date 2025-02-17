<?php
// Configurar encabezados para respuestas JSON y permitir CORS.
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Incluir el enrutador y los controladores.
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/controllers/CategoriaController.php';

$router = new Router();
// Rutas para Categorías.
$categoriaController = new CategoriaController();
$router->add('GET', '/categorias', fn() => $categoriaController->index());
$router->add('GET', '/categorias/:id', fn($id) => $categoriaController->show($id));
$router->add('POST', '/categorias', fn() => $categoriaController->store()); //REGISTRAR
$router->add('PUT', '/categorias/:id', fn($id) => $categoriaController->update($id)); //ACTUALIZAR
$router->add('DELETE', '/categorias/:id', fn($id) => $categoriaController->destroy($id)); //ELIMINAR


// Obtener la URI solicitada.
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/mvc-php/public';
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
if ($uri == '') {
    $uri = '/';
}

// Despachar la petición.
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);
?>