<?php

namespace App\Controllers;
use App\Config\responseHTTP;
use App\DB\connectionDB;
use App\Config\JwtHandler;  
use App\Models\LibrosModel;

//Controlador de libro//
class LibrosController {  
    private $Libro; 
    private $jwtHandler; 

    public function __construct($db) {  //Construccion de libro//
        $this->Libro = new LibrosModel ($db); 
        $this->jwtHandler=new JwtHandler ();
    }  

    public function obtenerLibros() {  //Obtener un libro//
        $Libro = $this->Libro->obtenerLibros();  
        header('Content-Type: application/json');  
        echo json_encode($Libro);  
    }  

    public function crearLibro() {
        $token = $this->jwtHandler->getHeaders();
        $token = $this->jwtHandler->extractToken($token);
        $decoded = $this->jwtHandler->verifyToken($token);

        if ($decoded) {
            // Token válido a usuario autenticado //
            $dataDB = json_decode(file_get_contents("php://input"), true);
            // Conexión a la base de datos al modelo //
            $nuevoLibroId = $this->Libro->crearLibro($dataDB);

            header('Content-Type: application/json');

            if ($nuevoLibroId) {
                http_response_code(201); // Recurso creado //
                echo json_encode(['id' => $nuevoLibroId, 'mensaje' => 'Libro creado con éxito']);
            } else {
                http_response_code(400); // Mensaje de error //
                echo json_encode(['mensaje' => 'Error al crear el libro']);
            }
        } else {
            // Error de no autorizacion //
            http_response_code(401);
            echo json_encode(responseHTTP::status401('No autorizado'));
        }
    }

    //conexion//
    final public function getAll ($endpoint){
        //validar//
        if ($this->method == 'get' && $endpoint == $this->route){
            return LibrosModel::getAll();
            exit;
        }
    }

}  

?>