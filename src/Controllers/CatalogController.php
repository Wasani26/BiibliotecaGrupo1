<?php
namespace App\Controllers;
namespace App\Config\responseHTTP;

//incompleto//
class CatalogController {
    private $method;
    private $route;
    private $params;
    private $data;
    private $headers;

public function __construct($method, $route, $params, $data, $headers){
    $this->method=$method;
    $this->route=$route;
    $this->params=$params;
    $this->data=$data;
    $this->headers=$headers;
}



}

?>
