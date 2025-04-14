<?php
use App\Config\errorlogs;
use App\Config\responseHTTP;
use App\Config\Security;
use App\Controllers\LibrosController;
use App\Models\LibrosModel;
  

$controller = new LibrosController ($data);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/libros') {  
    $controller->crearLibro();  
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/api/libros') {  
    $controller->obtenerLibros();  
} else {  
    http_response_code(404);  
    echo json_encode(['status' => 'error', 'message' => 'Ruta no encontrada']);  
}  

$method = strtolower($_SERVER['REQUEST_METHOD']); 
$route = $_GET['route']; //captura la ruta 
$params = explode('/', $route); 
$data = json_decode(file_get_contents("php://input"),true); 
$headers = getallheaders(); 

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