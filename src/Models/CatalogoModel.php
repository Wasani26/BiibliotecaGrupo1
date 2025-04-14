<?php
namespace App\Models;

class CatalogoModel extends connectionDB {
    private $Nombre;

    //Construtor//
    public function __construct($Nombre) {
        $this->Nombre=$Nombre;
    }
    public function __construct($db) {
        $this->db = $db; // Recibe la conexión a la base de datos en el constructor //
    }

    public function obtenerTodosLosLibros() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Registra el error para depuración
            error_log("CatalogoModel::obtenerTodosLosLibros -> " . $e->getMessage());
            return []; // Devuelve un array vacío en caso de error
        }
    }

    public function obtenerLibroPorId($id) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("CatalogoModel::obtenerLibroPorId -> " . $e->getMessage());
            return null; // Devuelve null en caso de error //
        }
    }

    public function buscarLibros($termino) {
        try {
            $termino = '%' . $termino . '%'; // Para búsquedas parciales (LIKE) //
            $query = "SELECT * FROM " . $this->table . " WHERE
                      titulo LIKE :termino OR
                      autor LIKE :termino OR
                      isbn LIKE :termino OR
                      categoria LIKE :termino"; // Puedes agregar más campos a la búsqueda //
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':termino', $termino, \PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("CatalogoModel::buscarLibros -> " . $e->getMessage());
            return []; // Devuelve un array vacío en caso de error //
        }
    }
}

?>