<?php

namespace App\Controllers;  //para indicar el nombre de espacio donde esta ubicado controllers

class UserController{
    private $method;
    private $route;
    private $params;
    private $data;
    private $headers;


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
        echo json_encode('post');
        exit;
    }
}

}