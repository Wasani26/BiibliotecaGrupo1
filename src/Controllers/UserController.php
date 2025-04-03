<?php

namespace App\Controllers; //para indicar el nombre de espacio donde esta ubicado controllers
use App\Config\responseHTTP;
use App\Config\Security;
use App\Models\UserModel;


class UserController{
    private $method;
    private $route;
    private $params;
    private $data;
    private $headers;


     // Expresiones regulares para validaciones
     private static $validar_rol = '/^[1,2,3]{1,1}$/'; // Valida roles permitidos (1, 2 o 3)
     private static $validar_numero = '/^[0-9]+$/'; // Valida solo números
     private static $validar_texto = '/^[a-zA-Z]+$/'; // Valida solo texto
     private static $validarTelefono = '/^\+?[0-9\s\-()]{7,15}$/'; // Permite:
      // - Números con signo "+" al inicio (opcional)
      // - Dígitos del 0 al 9
      // - Espacios, guiones, y paréntesis
      // - Una longitud de 7 a 15 caracteres (dependiendo del estándar que sigas)


public function __construct($method,$route,$params,$data,$headers){
    $this->method = $method;
    $this->route = $route;
    $this->params = $params;
    $this->data = $data;
    $this->headers = $headers;
 }

 //metodo que recibe un endpoint (ruta a un recurso)
 final public function post($endpoint){
    //validación de method y endpoint
    if($this->method == 'post' && $endpoint == $this->route){
        Security::validateTokenJwt($this->headers, Security::secretKey());
        //validacion que no vengan vacios
        if(empty($this->data['Nombre']) || empty($this->data['Telefono']) || empty($this->data['Correo_electronico']) || empty($this->data['Estado']) || empty($this->data['Rol_Id_Rol'])  ||
        empty($this->data['Contrasena']) || empty($this->data['confirmaContrasena'])){
            echo json_encode(responseHTTP::status400('Todos los campos son requeridos, proceda a llenarlos'));
            //validacion de campos de texto mediante preg_match
        }else if (!preg_match(self::$validar_texto, $this->data['Nombre'])){
            echo json_encode(responseHTTP::status400('Este campo solo permite texto'));
            //lo mismo evaluamos para numeros
        }else if(!preg_match(self::$validarTelefono, $this->data['Telefono'])) {
            echo json_encode(responseHTTP::status400('El campo Teléfono no tiene un formato válido'));
        }
        else if (!filter_var($this->data['Correo_electronico'], FILTER_VALIDATE_EMAIL)){
        echo json_encode(responseHTTP::status400('El formato de correo es incorrecto'));
          //validar Estado
        }else if (!preg_match(self::$validar_texto, $this->data['Estado'])){
            echo json_encode(responseHTTP::status400('Este campo solo permite texto'));
            //validar rol
        }else if (!preg_match(self::$validar_rol,$this->data['Rol_Id_Rol'])){
          echo json_encode(responseHTTP::status400('El rol puesto es invalido'));
        }else{
        new UserModel($this->data);
         echo json_encode(UserModel::post());
        }      
        //echo json_encode('post');
        exit;
    }

 }
     
     final public function getLogin($endpoint){
        //validar method y endpoint(ruta al recurso)
        if($this-> method == 'get' && $endpoint == $this-> route){
           $email = strtolower($this->params[1]);
           $pass = $this->params[2];
           //algunas otras validaciones
           if(empty($email) || empty($pass)){
               echo json_encode(responseHTTP::status400('Todos los campos son requeridos, proceda a llenarlos.'));
           } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
               echo json_encode(responseHTTP::status400('El correo debe llevar el formato correcto, proceda a corregir.'));
           }else{
              
             UserModel::setCorreo_electronico($email);
             UserModel::setContrasena($pass);
             echo json_encode(UserModel::Login());
        
        }
        
         exit;
     }
}

/*final public function delete($endpoint){
   //vaidacion en este caso para metodo delete
   if ($this->method == 'delete' && $endpoint == $this->route){
    echo json_encode('delete');   
     exit;
     }
 }*/
 

}