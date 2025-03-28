<?php
use App\Controllers\UserController;
use App\Config\responseHTTP;

$method = strtolower($_SERVER['REQUEST_METHOD']); //captura el método que se envía
$route = $_GET['route']; //captura la ruta
$params = explode('/', $route); //explode para ruta etc
$data = json_decode(file_get_contents("php://input"),true); //contiene la data
$headers = getallheaders(); //captura todas las cabeceras

$app = new UserController($method,$route,$params,$data,$headers); //instanciación clase user controlador

//recibe los parametros email y contraseña
$app->getLogin("auth/{$params[1]}/{$params[2]}/");

echo json_encode(responseHTTP::status404()); //error si no encuentra la ruta