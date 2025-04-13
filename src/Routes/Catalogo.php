<?php
use App\Config\errorlogs;
use App\Config\responseHTTP;
use App\Config\Security;
use App\Controllers\CatalogController;
use App\Models\CatalogModel;

$data = $data ?? null; // Ejemplo: si la conexión se inicializa en index.php

$controller = new CatalogController($data);

$method = $_SERVER['REQUEST_METHOD'];
$pathParts = explode('/', $_GET['route']);
$endpoint = $pathParts[1] ?? ''; // El segundo segmento de la URL después de 'libros' //

switch ($method) {
    case 'GET':
        if (empty($endpoint)) {
            // GET libros //
            $controller->listarLibros();
        } elseif (is_numeric($endpoint)) {
            // GET libros por id //
            $controller->obtenerLibroPorId($endpoint);
        } elseif ($endpoint === 'buscar') {
            // GET buscar //
            $controller->buscarLibros();
        } else {
            // Ruta GET no válida para libros //
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Ruta no encontrada para el catálogo']);
        }
        break;


    default:
        http_response_code(405); // Método no permitido //
        echo json_encode(['status' => 'error', 'message' => 'Método HTTP no permitido']);
        break;
}

?>