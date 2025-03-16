<?php

namespace App\Controllers; //para indicar el nombre de espacio donde esta ubicado controllers

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
      
        //más tarde aqui voy añadir las validaciones, tengo sueño xd


        echo json_encode('post');
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