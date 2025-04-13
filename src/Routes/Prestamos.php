<?php
use App\Config\responseHTTP;
use App\Controllers\PrestamoController;

$method = strtolower($_SERVER['REQUEST_METHOD']);
$route = $_GET['route'];
$params = explode('/', $route);
$data = json_decode(file_get_contents("php://input"), true);
$headers = getallheaders();

$PrestamoController = new PrestamoController($method, $route, $params, $data, $headers);

switch ($route) {
    // rutas para la gestion de prestamos
    case 'prestamos/crear':
        if ($method === 'POST') {
            $PrestamoController->crearPrestamo();
        } else {
            echo json_encode(responseHTTP::status404('Método no permitido'));
        }
        break;
    case 'prestamos/listar':
        if ($method === 'GET') {
            $PrestamoController->listarPrestamos();
        } else {
            echo json_encode(responseHTTP::status404('Método no permitido'));
        }
        break;
    case 'prestamos/obtener':
        if ($method === 'GET' && isset($params[1])) {
            $idHistorialPrestamos = $params[1];
            $PrestamoController->obtenerPrestamo($idHistorialPrestamos);
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta'));
        }
        break;
    case 'prestamos/actualizar':
        if ($method === 'PUT' && isset($params[1])) {
            $idHistorialPrestamos = $params[1];
            $PrestamoController->actualizarPrestamo($idHistorialPrestamos);
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta'));
        }
        break;
    case 'prestamos/eliminar':
        if ($method === 'DELETE' && isset($params[1])) {
            $idHistorialPrestamos = $params[1];
            $PrestamoController->eliminarPrestamo($idHistorialPrestamos);
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta'));
        }
        break;
}