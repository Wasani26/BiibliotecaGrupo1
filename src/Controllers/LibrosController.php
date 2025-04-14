<?php

use App\Config\responseHTTP;
use App\DB\connectionDB;
use App\Config\TokenJwt;  
use App\Models\LibrosModel;

//Controlador de libro//
class LibrosController {  
    private $Libro; 
    private $tokenjwt; 

    public function __construct($db) {  //Construccion de libro//
        $this->Libro = new LibrosModel ($db); 
        $this->tokenjwt=new TokenJwt ();
    }  

    public function obtenerLibros() {  //Obtener un libro//
        $Libro = $this->Libro->obtenerLibros();  
        header('Content-Type: application/json');  
        echo json_encode($Libro);  
    }  

    public function crearLibro() {
        $token = $this->tokenjwt->getHeaders();
        $token = $this->tokenjwt->extractTokenJwt($token);
        $decoded = $this->tokenjwt->verifyTokenJwt($token);

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

    public function eliminarLibro($id) {
        $eliminado = $this->Libro->eliminarLibro($id);
        header('Content-Type: application/json');

        if ($eliminado) {
            echo json_encode(['mensaje' => 'Libro eliminado con éxito']);
        } else {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Libro no encontrado o error al eliminar']);
        }
    }

}

?>