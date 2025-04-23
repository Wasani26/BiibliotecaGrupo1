<?php

/*use App\Models\UserModel;*/
use App\Config\responseHTTP;
use App\Controllers\UserController;


$method = strtolower($_SERVER['REQUEST_METHOD']);
$route = $_GET['route']; //captura la ruta
$params = explode('/', $route);
$data = json_decode(file_get_contents("php://input"),true);
$headers = getallheaders();
$caso = filter_input(INPUT_GET, 'caso');

if ($caso != ''){
    $params += [ 1 => filter_input(INPUT_GET, 'usuario'),
                2 => filter_input(INPUT_GET, 'clave') ];
}


// El correo y la contraseña ya están en $params según la estructura de la ruta
/*$email = isset($params[1]) ? $params[1] : null;
$pass = isset($params[2]) ? $params[2] : null;*/
// Registra los valores obtenidos para confirmarlos
/*error_log("Correo capturado desde ruta: $email, Contraseña capturada: $pass");*/
/*error_log("Segmentos de ruta capturados: " . print_r($params, true));*/


/*error_log("Creando instancia de UserController");*/
/*$app = new UserController($method, $route, $params, $data, $headers);*/
/*error_log("Instancia creada, llamando a getLogin");*/
//$app->getLogin('login');
/*error_log("getLogin ejecutado");*/


exit;

echo json_encode(responseHTTP::status404('Error mijo')); //si no encuentra la ruta

/*if ($url[0] === 'login') {
    $correo = $url[1] ?? null;
    $password = $url[2] ?? null;

    if ($correo && $password) {
        $result = UserModel::Login($correo, $password);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(responseHTTP::status400('Faltan correo o contraseña en la URL'));
        exit;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(responseHTTP::status404('Ruta no encontrada'));
    exit;
}


$caso = filter_input(INPUT_GET,"caso");
switch($caso){
    case 'login':
        login($method,$route,$params,$data,$headers);
        break;
}*/





