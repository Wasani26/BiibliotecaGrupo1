<?php
use App\DB\connectionDB;
use App\Config\responseHTTP;
use  App\Controllers\BookController;

require_once 'public/index.php';   

$controller = new BookController ($data);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/libros') {  
    $controller->crearLibro();  
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/api/libros') {  
    $controller->obtenerLibros();  
} else {  
    http_response_code(404);  
    echo json_encode(['status' => 'error', 'message' => 'Ruta no encontrada']);  
}  
?>