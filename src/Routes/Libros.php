<?php
use App\Config\errorlogs;
use App\Config\responseHTTP;
use App\Config\Security;
use App\Controllers\LibrosController;
require_once 'controllers/LibrosController.php';
  

$method = strtolower($_SERVER['REQUEST_METHOD']); 
$route = $_GET['route']; //captura la ruta 
$params = explode('/', $route); 
$data = json_decode(file_get_contents("php://input"),true); 
$headers = getallheaders(); 

$controller = new LibrosController ($method, $route, $params, $data, $headers);
$caso = filter_input(INPUT_GET, "caso");
switch($caso) { // Evaluar $caso  //
    case 'obtenerLibros':  
        $controller->obtenerLibros($data); // Llamar método Obtener Libros  
        break;  
    case 'crearLibro': 
      //  $data = json_decode(file_get_contents("php://input"), true)    
        $controller->crearLibro($data);
        break;
    case 'eliminarLibro':
        $controller->eliminarLibro($data);
    default:  
        echo json_encode(responseHTTP::status200('La ruta no existe'));  
        break;  
}  


?>