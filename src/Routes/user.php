<?php
//echo "llegue al recurso user";

require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; // Cargar el autoload de Composer y está alternativa la saque de chat gpt (apuntado en notas)

use App\Controllers\UserController; //cambio la importación a ver que tal
use App\Config\responseHTTP; //otro cambio en la importación de una clase


$method = strtolower($_SERVER['REQUEST_METHOD']); //captura el metodo que se envia
$route = $_GET['route']; //capturamos la ruta 
$params = explode('/', $route); 
$data = json_decode(file_get_contents("php://input"),true); //contendra la data que enviemos por cualquier metodo excepto get, array asociativo
$headers = getallheaders(); //capturando todas las cabeceras que nos envian

$app = new UserController($method, $route, $params, $data, $headers);

$app->post('user'); //llamada al metodo post con la ruta al recurso
$app->delete('user'); //llamada de delete

/*$caso = filter_input(INPUT_GET,"caso");
switch($caso){
    case 'user':
        $app = new UserController($method, $route, $params, $data, $headers);
        $app->post('user');
        exit;
}*/


echo json_encode(responseHTTP::status404()); //imprimamos un error en caso de no encontrar la ruta