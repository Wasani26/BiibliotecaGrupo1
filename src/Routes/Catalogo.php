<?php
use App\Config\errorlogs;
use App\Config\responseHTTP;
use App\Controllers\CatalogController;

$controller = new CatalogController($db);

$method = $_SERVER['REQUEST_METHOD'];
$pathParts = explode('/', $_GET['route'] ?? '');
$endpoint = $pathParts[1] ?? '';

switch ($method) {
    case 'GET':
        if (empty($endpoint)) {
            $controller->listarLibros();
        } elseif ($endpoint === 'buscar') {
            $controller->buscarLibros();
        } elseif (is_numeric($endpoint)) {
            $controller->obtenerLibroPorId($endpoint);
        } else {
            http_response_code(404);
            echo json_encode(responseHTTP::status404('Ruta GET no encontrada para el catálogo'));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(responseHTTP::status405('Método HTTP no permitido para /catalogo'));
        break;
}

?>