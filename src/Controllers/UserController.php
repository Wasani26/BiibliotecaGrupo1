<?php

namespace App\Controllers; //para indicar el nombre de espacio donde esta ubicado controllers
use App\Config\responseHTTP;


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
        //validacion que no vengan vacios
        if(empty($this->data['Nombre']) || empty($this->data['Telefono']) || empty($this->data['Correo_electronico']) || empty($this->data['Estado']) || empty($this->data['Rol'])  ||
        empty($this->data['Contrasena']) || empty($this->data['confirmaContrasena'])){
            echo json_encode(responseHTTP::status400('Todos los campos son requeridos, proceda a llenarlos'));
            //validacion de campos de texto mediante preg_match
        }else if (!preg_match(self::$validar_texto, $this->data['Nombre'])){
            echo json_encode(responseHTTP::status400('Este campo solo permite texto'));
            //lo mismo evaluamos para numeros
        }else if (!preg_match(self::$validar_numero, $this->data['Telefono'])){
             echo json_encode(responseHTTP::status400('Este campo Telefono solo acepta números'));
             //validamos correo usando filter_var
        }else if (!filter_var($this->data['Correo_electronico'], FILTER_VALIDATE_EMAIL)){
        echo json_encode(responseHTTP::status400('El formato de correo es incorrecto'));
          //validar Estado
        }else if (!preg_match(self::$validar_texto, $this->data['Estado'])){
            echo json_encode(responseHTTP::status400('Este campo solo permite texto'));
            //validar rol
        }else if (!preg_match(self::$validar_rol,$this->data['Rol'])){
          echo json_encode(responseHTTP::status400('El rol puesto es invalido'));
        }else{
        
        }      
        //echo json_encode('post');
        exit;
    }

 }

public function delete($endpoint){
   //vaidacion en este caso para metodo delete
   if ($this->method == 'delete' && $endpoint == $this->route){
    echo json_encode('delete');   
     exit;
     }
 }
 

}