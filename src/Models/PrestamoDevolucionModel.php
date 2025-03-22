<?php
namespace App\Models;
use App\DB\connectionDB;
use App\DB\sql;
use App\Config\responseHTTP;

class PrestamoDevolucionModel extends connectionDB
{
    private static $Id_Historial_Prestamos;
    private static $Fecha_prestamo;
    private static $Fecha_devolucion;
    private static $Libros_Id_Libros;
    private static $Usuarios_Id_Usuarios;
    // atributos de la tabla Devoluciones
    private static $Id_Devoluciones;
    // constructor
    public function __construct(array $data)
    {
        self::$Id_Historial_Prestamos = $data['Id_Historial_Prestamos'];
        self::$Fecha_prestamo = $data['Fecha_prestamo'];
        self::$Fecha_devolucion = $data['Fecha_devolucion'];
        self::$Libros_Id_Libros = $data['Libros_Id_Libros'];
        self::$Usuarios_Id_Usuarios = $data['Usuarios_Id_Usuarios'];
        // atributos de la tabla Devoluciones
        self::$Id_Devoluciones = $data['Id_Devoluciones'];
    }

    // metodos get
final public static function getIdHistorialPrestamos() { return self::$Id_Historial_Prestamos; }
final public static function getFechaprestamo() { return self::$Fecha_prestamo; }
final public static function getFechadevolucion() { return self::$Fecha_devolucion; }
final public static function getLibrosIdLibros() { return self::$Libros_Id_Libros; }
final public static function getUsuariosIdUsuarios() { return self::$Usuarios_Id_Usuarios; }
final public static function getIdDevoluciones() { return self::$Id_Devoluciones; }
    // métodos set
    final public static function setIdHistorialPrestamos($id) { self::$Id_Historial_Prestamos = $id; }
    final public static function setFechaprestamo($fecha) { self::$Fecha_prestamo = $fecha; }
    final public static function setFechadevolucion($fecha) { self::$Fecha_devolucion = $fecha; }
    final public static function setLibrosIdLibros($id) { self::$Libros_Id_Libros = $id; }
    final public static function setUsuariosIdUsuarios($id) { self::$Usuarios_Id_Usuarios = $id; }
    final public static function setIdDevoluciones($id) { self::$Id_Devoluciones = $id; }

    // Registrar un nuevo Prestamo
    final public static function registrarPrestamo()
    {
        try {
            $con = self::getConnection();
            $query = "INSERT INTO Historial_Prestamos (Fecha_prestamo, Libros_Id_Libros, Usuarios_Id_Usuarios) VALUES (:Fecha_prestamo, :Libros_id_libros, :Usuarios_id_usuarios)";
            $stmt = $con->prepare($query);
            $stmt->execute([
                ':fecha_prestamo' => self::$Fecha_prestamo,
                ':libros_id_libros' => self::$Libros_Id_Libros,
                ':usuarios_id_usuarios' => self::$Usuarios_Id_Usuarios,
            ]);

            if ($stmt->rowCount() > 0) {
                return responseHTTP::status200('Prestamo registrado correctamente');
            } else {
                return responseHTTP::status500('Error al registrar el prestamo.');
            }
        } catch (\PDOException $e) {
            error_log('PrestamoDevolucionModel::registrarPrestamo -> ' . $e);
            return responseHTTP::status500('Error interno del servidor.');
        }
    }

    // Registrar una nueva devolucion
    final public static function registrarDevolucion()
    {
        try {
            $con = self::getConnection();
            $query = "INSERT INTO Devoluciones (Fecha_Devolucion, Historial_Prestamos_Id_Historial_Prestamos, Usuarios_Id_Usuarios) VALUES (:Fecha_Devolucion, :Historial_Prestamos_Id_Historial_Prestamos, :Usuarios_Id_Usuarios)";
            $stmt = $con->prepare($query);
            $stmt->execute([
                ':Fecha_devolucion' => self::$Fecha_devolucion,
                ':Historial_Prestamos_Id_Historial_Prestamos' => self::$Id_Historial_Prestamos,
                ':Usuarios_Id_Usuarios' => self::$Usuarios_Id_Usuarios,
            ]);

            if ($stmt->rowCount() > 0) {
                return responseHTTP::status200('Devolución registrada correctamente.');
            } else {
                return responseHTTP::status500('Error al registrar la devolucion.');
            }
        } catch (\PDOException $e) {
            error_log('PrestamoDevolucionModel::registrarDevolucion -> ' . $e);
            return responseHTTP::status500('Error interno del servidor.');
        }
    }

    // Obtener todos los prestamos
    final public static function obtenerPrestamos()
    {
        try {
            $con = self::getConnection();
            $query = "SELECT * FROM Historial_Prestamos";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $res['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            error_log('PrestamoDevolucionModel::obtenerPrestamos -> ' . $e);
            return responseHTTP::status500('Error interno del servidor.');
        }
    }

    // Obtener todas las devoluciones
    final public static function obtenerDevoluciones()
    {
        try {
            $con = self::getConnection();
            $query = "SELECT * FROM Devoluciones";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $res['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            error_log('PrestamoDevolucionModel::obtenerDevoluciones -> ' . $e);
            return responseHTTP::status500('Error interno del servidor.');
        }
    }
}