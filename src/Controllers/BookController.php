<?php
use App\Config\responseHTTP;
use App\DB\connectionDB;  
use App\Models\BookModel;

//Controlador de libro//
class BookController {  
    private $Libro;  

    public function __construct($db) {  //Construccion de libro//
        $this->Libro = new BookModel ($db);  
    }  

    public function obtenerLibros() {  //Obtener un libro//
        $Libro = $this->Libro->obtenerLibros();  
        header('Content-Type: application/json');  
        echo json_encode($Libro);  
    }  

    public function crearLibro() {  //Creacion de libro//
        $dataDB = json_decode(file_get_contents("php://input"), true);  
        $nuevoLibroId = $this->Libro->crearLibro($db);  
        header('Content-Type: application/json');  

        if ($nuevoLibroId) {  
            http_response_code(201);  //Recurso creado//
            echo json_encode(['id' => $nuevoLibroId, 'mensaje' => 'Libro creado con éxito']);  
        } else {  
            http_response_code(400);  //Mensaje de error//
            echo json_encode(['mensaje' => 'Error al crear el libro']);  
        }  
    }  
}  

?>