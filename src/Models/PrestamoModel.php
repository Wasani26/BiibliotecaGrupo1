<?php
namespace App\Models;
use App\DB\connectionDB;
use App\DB\sql;
use App\Config\responseHTTP;
use App\Config\Security;
class PrestamoModel extends connectionDB {
    private static $Id_Historial_Prestamos;
    private static $Fecha_prestamo;
    private static $Fecha_devolucion;
    private static $Libros_Id_Libros;
    private static $Usuarios_Id_Usuarios;

    public function __construct(array $data)
    {
        if ($data) {
            self::$Id_Historial_Prestamos = $data['Id_Historial_Prestamos'];
            self::$Fecha_prestamo = $data['Fecha_prestamo'];
            self::$Fecha_devolucion = $data['Fecha_devolucion'];
            self::$Libros_Id_Libros = $data['Libros_Id_Libros'];
            self::$Usuarios_Id_Usuarios = $data['Usuarios_Id_Usuarios'];
        }
    }

    // metodos Get
    final public static function getIdHistorialPrestamos(){return self::$Id_Historial_Prestamos;}
    final public static function getFechaPrestamo(){return self::$Fecha_prestamo;}
    final public static function getFechaDevolucion(){return self::$Fecha_devolucion;}
    final public static function getLibrosIdLibros(){return self::$Libros_Id_Libros;}
    final public static function getUsuariosIdUsuarios(){ return self::$Usuarios_Id_Usuarios;}

    // metodos Set
    final public static function setIdHistorialPrestamos($Id_Historial_Prestamos){self::$Id_Historial_Prestamos = $Id_Historial_Prestamos;}
    final public static function setFechaPrestamo($Fecha_prestamo){ self::$Fecha_prestamo = $Fecha_prestamo;}
    final public static function setFechaDevolucion($Fecha_devolucion){self::$Fecha_devolucion = $Fecha_devolucion;}
    final public static function setLibrosIdLibros($Libros_Id_Libros){self::$Libros_Id_Libros = $Libros_Id_Libros;}
    final public static function setUsuariosIdUsuarios($Usuarios_Id_Usuarios){self::$Usuarios_Id_Usuarios = $Usuarios_Id_Usuarios;}

    //(CRUD)

    final public function getAll()
    {
        try {
            $con = $this->getConnection();
            $query = "SELECT Id_Historial_Prestamos, Fecha_prestamo, Fecha_devolucion, Libros_Id_Libros, Usuarios_Id_Usuarios FROM Historial_Prestamos";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("HistorialPrestamoModel::getAll -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function getById($id)
    {
        try {
            $con = $this->getConnection();
            $query = "SELECT Id_Historial_Prestamos, Fecha_prestamo, Fecha_devolucion, Libros_Id_Libros, Usuarios_Id_Usuarios FROM Historial_Prestamos WHERE Id_Historial_Prestamos = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("HistorialPrestamoModel::getById -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function insert(array $data)
    {
        try {
            $con = $this->getConnection();
            $query = "INSERT INTO Historial_Prestamos (Fecha_prestamo, Fecha_devolucion, Libros_Id_Libros, Usuarios_Id_Usuarios) 
                      VALUES (:fecha_prestamo, :fecha_devolucion, :libros_id_libros, :usuarios_id_usuarios)";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':fecha_prestamo', $data['Fecha_prestamo'], \PDO::PARAM_STR);
            $stmt->bindParam(':fecha_devolucion', $data['Fecha_devolucion'], \PDO::PARAM_STR);
            $stmt->bindParam(':libros_id_libros', $data['Libros_Id_Libros'], \PDO::PARAM_INT);
            $stmt->bindParam(':usuarios_id_usuarios', $data['Usuarios_Id_Usuarios'], \PDO::PARAM_INT);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (\PDOException $e) {
            error_log("HistorialPrestamoModel::insert -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function update($id, array $data)
    {
        try {
            $con = $this->getConnection();
            $setClauses = [];
            foreach ($data as $key => $value) {
                if ($key !== 'Id_Historial_Prestamos') {
                    $setClauses[] = "$key = :$key";
                }
            }
            if (empty($setClauses)) {
                return true; // No data to update
            }
            $query = "UPDATE Historial_Prestamos SET " . implode(', ', $setClauses) . " WHERE Id_Historial_Prestamos = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            foreach ($data as $key => $value) {
                if ($key !== 'Id_Historial_Prestamos') {
                    $stmt->bindValue(":$key", $value);
                }
            }
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("HistorialPrestamoModel::update -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function delete($id)
    {
        try {
            $con = $this->getConnection();
            $query = "DELETE FROM Historial_Prestamos WHERE Id_Historial_Prestamos = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("HistorialPrestamoModel::delete -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }
}
