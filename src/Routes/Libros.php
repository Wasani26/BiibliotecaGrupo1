<?php
use App\Config\errorlogs;
use App\Config\responseHTTP;
use App\Config\Security;
use App\Controllers\LibrosController;
require_once 'controllers/LibrosController.php';


$db = $db ?? null;
$controller = new LibrosController($db);

$method = strtolower($_SERVER['REQUEST_METHOD']);
$pathParts = explode('/', $_GET['route'] ?? '');
$endpoint = $pathParts[1] ?? '';

switch ($method) {
    case 'get':
        if (empty($endpoint)) {
            $controller->obtenerLibros();
        } 
        break;
    case 'post':
        if (empty($endpoint)) {
            $controller->crearLibro();
        }
        break;
    case 'delete':
        if (is_numeric($endpoint)) {
            $controller->eliminarLibro($endpoint);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Se requiere un ID para eliminar un libro']);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(responseHTTP::status405('Método HTTP no permitido para /libros'));
        break;
}


?>