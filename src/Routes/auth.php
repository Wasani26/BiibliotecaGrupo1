<?php

use App\Config\Security;

//echo json_encode(Security::secretKey());
//echo json_encode(Security::createPassword("hola"));


//validacion de la contraseña
/*$pass = Security::createPassword("hola");
if(Security::validatePassword("hola",$pass)){
    echo json_encode("Contraseña correcta");
}else{
    echo json_encode("Contraseña incorrecta");
}

//jwt 
//echo json_encode(Security::createTokenJwt(Security::secretKey(),["hola"]));
echo(json_encode(Security::createTokenJwt(Security::secretKey(),["hola"])));*/
$caso = filter_input(INPUT_GET,"caso");

//prueba la conexión BD
use App\DB\connectionDB;
connectionDB::getConnection();