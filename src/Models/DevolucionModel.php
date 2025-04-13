<?php
namespace App\Models;
use App\DB\connectionDB;
use App\DB\sql;
use App\Config\responseHTTP;
use App\Config\Security;
class DevolucionModel extends connectionDB{
    private static $Id_Devoluciones;
    private static $Fecha_devolucion;
    private static $Historial_Prestamos_Id_Historial_Prestamos;
    private static $Usuarios_Id_Usuarios;

    public function __construct(array $data )
    {
        if ($data) {
            self::$Id_Devoluciones = $data['Id_Devoluciones'];
            self::$Fecha_devolucion = $data['Fecha_devolucion'];
            self::$Historial_Prestamos_Id_Historial_Prestamos = $data['Historial_Prestamos_Id_Historial_Prestamos'];
            self::$Usuarios_Id_Usuarios = $data['Usuarios_Id_Usuarios'];
        }
    }

    // metodos Get
    final public static function getIdDevoluciones(){return self::$Id_Devoluciones;}
    final public static function getFechaDevolucion(){return self::$Fecha_devolucion;}
    final public static function getHistorialPrestamosIdHistorialPrestamos(){return self::$Historial_Prestamos_Id_Historial_Prestamos;}
    final public static function getUsuariosIdUsuarios() {return self::$Usuarios_Id_Usuarios;}

    // Métodos Set
    final public static function setIdDevoluciones($Id_Devoluciones){self::$Id_Devoluciones = $Id_Devoluciones;}
    final public static function setFechaDevolucion($Fecha_devolucion){self::$Fecha_devolucion = $Fecha_devolucion;}
    final public static function setHistorialPrestamosIdHistorialPrestamos($Historial_Prestamos_Id_Historial_Prestamos){self::$Historial_Prestamos_Id_Historial_Prestamos = $Historial_Prestamos_Id_Historial_Prestamos;}
    final public static function setUsuariosIdUsuarios($Usuarios_Id_Usuarios){self::$Usuarios_Id_Usuarios = $Usuarios_Id_Usuarios;}

    //(CRUD)

    final public function getAll()
    {
        try {
            $con = $this->getConnection();
            $query = "SELECT Id_Devoluciones, Fecha_devolucion, Historial_Prestamos_Id_Historial_Prestamos, Usuarios_Id_Usuarios FROM Devoluciones";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("DevolucionModel::getAll -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function getById($id)
    {
        try {
            $con = $this->getConnection();
            $query = "SELECT Id_Devoluciones, Fecha_devolucion, Historial_Prestamos_Id_Historial_Prestamos, Usuarios_Id_Usuarios FROM Devoluciones WHERE Id_Devoluciones = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("DevolucionModel::getById -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function insert(array $data)
    {
        try {
            $con = $this->getConnection();
            $query = "INSERT INTO Devoluciones (Fecha_devolucion, Historial_Prestamos_Id_Historial_Prestamos, Usuarios_Id_Usuarios) 
                      VALUES (:fecha_devolucion, :historial_prestamos_id, :usuarios_id)";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':fecha_devolucion', $data['Fecha_devolucion'], \PDO::PARAM_STR);
            $stmt->bindParam(':historial_prestamos_id', $data['Historial_Prestamos_Id_Historial_Prestamos'], \PDO::PARAM_INT);
            $stmt->bindParam(':usuarios_id', $data['Usuarios_Id_Usuarios'], \PDO::PARAM_INT);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (\PDOException $e) {
            error_log("DevolucionModel::insert -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function update($id, array $data)
    {
        try {
            $con = $this->getConnection();
            $setClauses = [];
            foreach ($data as $key => $value) {
                if ($key !== 'Id_Devoluciones') {
                    $setClauses[] = "$key = :$key";
                }
            }
            if (empty($setClauses)) {
                return true; // No data to update
            }
            $query = "UPDATE Devoluciones SET " . implode(', ', $setClauses) . " WHERE Id_Devoluciones = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            foreach ($data as $key => $value) {
                if ($key !== 'Id_Devoluciones') {
                    $stmt->bindValue(":$key", $value);
                }
            }
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("DevolucionModel::update -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }

    final public function delete($id)
    {
        try {
            $con = $this->getConnection();
            $query = "DELETE FROM Devoluciones WHERE Id_Devoluciones = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("DevolucionModel::delete -> " . $e);
            die(json_encode(responseHTTP::status500()));
        }
    }
}