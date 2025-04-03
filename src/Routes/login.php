<?php
use App\Controllers\UserController;
use App\Config\responseHTTP;

$method = strtolower($_SERVER['REQUEST_METHOD']); //captura el método que se envía
$route = $_GET['route']; //captura la ruta
$params = explode('/', $route); //explode para ruta etc
$data = json_decode(file_get_contents("php://input"),true); //contiene la data
$headers = getallheaders(); //captura todas las cabeceras


$app = new UserController($method,$route,$params,$data,$headers); //instanciación clase user controlador
//metodo getlogin del controlador con la ruta al recurso, params[0] contiene la ruta 
$app->getLogin("login/{$params[1]}/{$params[2]}/");
echo json_decode(responseHTTP::status404());

/*function login($method,$route,$params,$data,$headers){
    $params += [1 => filter_input(INPUT_GET,"Nombre"), 2 => filter_input(INPUT_GET,"Contrasena")];
    $app = new UserController($method,$route,$params,$data,$headers); //instanciación clase user controlador
   
    $app->getLogin('login');
    exit;
   
    echo json_encode(responseHTTP::status404()); //error si no encuentra la ruta
}*/




