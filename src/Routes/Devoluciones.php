<?php
use App\Config\responseHTTP;
use App\Controllers\DevolucionController;

$method = strtolower($_SERVER['REQUEST_METHOD']);
$route = $_GET['route'];
$params = explode('/', $route);
$data = json_decode(file_get_contents("php://input"), true);
$headers = getallheaders();

$DevolucionController = new DevolucionController($method, $route, $params, $data, $headers);
    // Rutas para la gestion de devoluciones
    case 'devoluciones/crear':
        if ($method === 'POST') {
            $DevolucionController->crearDevolucion();
        } else {
            echo json_encode(responseHTTP::status404('Método no permitido'));
        }
        break;
    case 'devoluciones/listar':
        if ($method === 'GET') {
            $DevolucionController->listarDevoluciones();
        } else {
            echo json_encode(responseHTTP::status404('Método no permitido'));
        }
        break;
    case 'devoluciones/obtener':
        if ($method === 'GET' && isset($params[1])) {
            $idDevoluciones = $params[1];
            $DevolucionController->obtenerDevolucion($idDevoluciones);
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta'));
        }
        break;
    case 'devoluciones/actualizar':
        if ($method === 'PUT' && isset($params[1])) {
            $idDevoluciones = $params[1];
            $DevolucionControllerController->actualizarDevolucion($idDevoluciones);
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta'));
        }
        break;
    case 'devoluciones/eliminar':
        if ($method === 'DELETE' && isset($params[1])) {
            $idDevoluciones = $params[1];
            $DevolucionControllerController->eliminarDevolucion($idDevoluciones);
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta'));
        }
        break;

    default:
        echo json_encode(responseHTTP::status404('Ruta no encontrada'));
        break;
}