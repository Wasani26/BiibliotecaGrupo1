<?php
use App\Controllers\NotificacionesController;
use App\Config\responseHTTP;

$method = strtolower($_SERVER['REQUEST_METHOD']); // Capturamos el método HTTP (GET, POST, PUT, DELETE)
$route = $_GET['route']; // Capturamos la ruta solicitada en la URL
$params = explode('/', $route); // Dividimos la ruta en segmentos para obtener parámetros
$data = json_decode(file_get_contents("php://input"), true); // Obtenemos los datos enviados en el cuerpo de la petición (JSON), si existen
$headers = getallheaders(); // Obtenemos todas las cabeceras de la petición

$caso = filter_input(INPUT_GET, "caso"); // Obtenemos el parámetro 'caso' de la URL para determinar la acción

switch ($caso) {
    case 'guardarNotificacion':
        // Recogemos los datos necesarios para guardar una nueva notificación
        $data['Mensaje'] = filter_input(INPUT_POST, "Mensaje");
        $data['Fecha_envio'] = filter_input(INPUT_POST, "Fecha_envio");
        $data['Usuarios_Id_Usuarios'] = filter_input(INPUT_POST, "Usuarios_Id_Usuarios");

        $notificacionesController = new notificacionesController($method, $route, $params, $data, $headers);
        $notificacionesController->guardarNotificacion($route);
        break;

    case 'obtenerNotificacion':
        // Recogemos el ID de la notificación que se desea obtener
        $data['Id_Notificaciones'] = filter_input(INPUT_GET, "Id_Notificaciones");

        $notificacionesController = new notificacionesController($method, $route, $params, $data, $headers);
        $notificacionesController->obtenerNotificacion($route);
        break;

    case 'obtenerTodasNotificaciones':
        $notificacionesController = new notificacionesController($method, $route, $params, $data, $headers);
        $notificacionesController->obtenerTodasNotificaciones($route);
        break;

    case 'actualizarNotificacion':
        // Recogemos los datos necesarios para actualizar una notificación existente
        $data['Id_Notificaciones'] = filter_input(INPUT_POST, "Id_Notificaciones"); // Es importante tener el ID para identificar la notificación a actualizar
        $data['Mensaje'] = filter_input(INPUT_POST, "Mensaje");
        $data['Fecha_envio'] = filter_input(INPUT_POST, "Fecha_envio");
        $data['Usuarios_Id_Usuarios'] = filter_input(INPUT_POST, "Usuarios_Id_Usuarios");

        $notificacionesController = new notificacionesController($method, $route, $params, $data, $headers);
        $notificacionesController->actualizarNotificacion($route);
        break;

    case 'eliminarNotificacion':
        // Recogemos el ID de la notificación que se desea eliminar
        $data['Id_Notificaciones'] = filter_input(INPUT_GET, "Id_Notificaciones");

        $notificacionesController = new notificacionesController($method, $route, $params, $data, $headers);
        $notificacionesController->eliminarNotificacion($route);
        break;

    default:
        echo json_encode(responseHTTP::status200('La ruta o la acción solicitada para las notificaciones no existe.'));
        break;
}