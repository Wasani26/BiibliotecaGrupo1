<?php
//echo "llegue al recurso user";
require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; // Cargar el autoload de Composer y está alternativa la saque de chat gpt (apuntado en notas)

use App\Controllers; //cambie este nombre de espacios por el apropiado
use App\Config;

$method = strtolower($_SERVER['REQUEST_METHOD']); //captura el metodo que se envia
$route = $_GET['route']; //capturamos la ruta 
$params = explode('/', $route); 
$data = json_decode(file_get_contents("php://input"),true); //contendra la data que enviemos por cualquier metodo excepto get, array asociativo
$headers = getallheaders(); //capturando todas las cabeceras que nos envian
echo $method;
$app = new UserController($method, $route, $params, $data, $headers); //instancia clase user controlador
$app->post('user/'); //llamada al metodo post con la ruta al recurso


echo json_encode(responseHTTP::status404()); //imprimamos un error en caso de no encontrar la ruta