<?php
namespace App\Models;
use App\Config\responseHTTP;
use App\DB\connectionDB;

class LibrosModel extends connectionDB{

    private $db;
    //Conexion de propiedas privadas//
    private $Titulo;
    private $autor;
    private $ISBN;
    private $Categoria;
    private $Disponibilidad;
    private $Ubicacion_biblioteca;
    private $Resumen;
    private $Portada;

    public function __construct($db, $Titulo = null, $autor = null, $ISBN = null, $Categoria = null, $Disponibilidad = null, $Ubicacion_biblioteca = null, $Resumen = null, $Portada = null) {
        $this->db = $db; // Inicializa la conexión a la base de datos
        $this->Titulo = $Titulo;
        $this->autor = $autor;
        $this->ISBN = $ISBN;
        $this->Categoria = $Categoria;
        $this->Disponibilidad = $Disponibilidad;
        $this->Ubicacion_biblioteca = $Ubicacion_biblioteca;
        $this->Resumen = $Resumen;
        $this->Portada = $Portada;
    }
    
    //Getters//
    public function getTitulo()  { return $this->Titulo; }
    public function getAutor()  { return $this->autor; }
    public function getISBN()  { return $this->ISBN; }
    public function getCategoria()  { return $this->Categoria; }
    public function getDisponibilidad()  { return $this->Disponibilidad; }
    public function getUbicacionBiblioteca()  { return $this->Ubicacion_biblioteca; }
    public function getResumen()  { return $this->Resumen; }
    public function getPortada()  { return $this->Portada; }

    //Setters//
    public function setTitulo($Titulo)  { return $this->Titulo; }
    public function setAutor($autor)  { return $this->autor; }
    public function setISBN($ISBN)  { return $this->ISBN; }
    public function setCategoria($Categoria)  { return $this->Categoria; }
    public function setDisponibilidad($Disponibilidad)  { return $this->Disponibilidad; }
    public function setUbicacionBiblioteca($Ubicacion_biblioteca)  {  return $this->Ubicacion_biblioteca; }
    public function setResumen($Resumen)  { return $this->Resumen; }
    public function setPortada($Portada)  {  return $this->Portada; }

    // Interaccion con la base de datos //
    public function crearLibro($data) {   
        $query = "INSERT INTO libros (Titulo, autor, ISBN, Categoria, Disponibilidad, Ubicacion_biblioteca, Resumen, Portada)   
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";  
        $stmt = $this->db->prepare($query);  
        
        $stmt->execute([  
            $data['Titulo'],   
            $data['autor'],   
            $data['ISBN'],   
            $data['Categoria'],   
            $data['Disponibilidad'],   
            $data['Ubicacion_biblioteca'],   
            $data['Resumen'],  
            $data['Portada']  
        ]);  
        return $this->db->lastInsertId(); // Devuelve el ID del nuevo libro  //
    }  

    public function obtenerLibros() {  
        $query = "SELECT * FROM libros";   
        $stmt = $this->db->query($query);  
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }  

    public function eliminarLibro($id) {
        try {
            $query = "DELETE FROM libros WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->rowCount(); // Devuelve el número de filas afectadas //
        } catch (\PDOException $e) {
            error_log("LibrosModel::eliminarLibro -> " . $e->getMessage());
            return 0; 
        }


}
}

?>