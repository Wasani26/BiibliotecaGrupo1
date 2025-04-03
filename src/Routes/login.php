<?php

use App\Models\UserModel;
use App\Config\responseHTTP;

$url = explode('/', $_GET['route']);

if ($url[0] === 'login') {
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
/*function login($method,$route,$params,$data,$headers){
    $params += [1 => filter_input(INPUT_GET,"Nombre"), 2 => filter_input(INPUT_GET,"Contrasena")];
    $app = new UserController($method,$route,$params,$data,$headers); //instanciación clase user controlador
   
    $app->getLogin('login');
    exit;
   
    echo json_encode(responseHTTP::status404()); //error si no encuentra la ruta
}*/




