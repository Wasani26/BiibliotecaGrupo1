<?php
namespace App\Models;
use App\DB\connectionDB;
use App\DB\sql;
use App\Config\responseHTTP;
use App\Config\Security;

class NotificacionesModel extends connectionDB
{
    private static $id_notificaciones;
    private static $mensaje;
    private static $fecha_envio;
    private static $usuarios_id_usuarios;

    //constructor
    public function __construct(array $data)
    {
        if ($data) {
            self::$id_notificaciones = $data['Id_Notificaciones'];
            self::$mensaje = $data['Mensaje'];
            self::$fecha_envio = $data['Fecha_envio'];
            self::$usuarios_id_usuarios = $data['Usuarios_Id_Usuarios'];
        }
    }

    //metodos gets
    final public static function getIdNotificaciones(){return self::$id_notificaciones;}
    final public static function getMensaje(){return self::$mensaje;}
    final public static function getFechaEnvio(){return self::$fecha_envio;}
    final public static function getUsuariosIdUsuarios(){return self::$usuarios_id_usuarios;}

    //metodos set
    final public static function setIdNotificaciones($id_notificaciones){self::$id_notificaciones = $id_notificaciones;}
    final public static function setMensaje($mensaje){self::$mensaje = $mensaje;}
    final public static function setFechaEnvio($fecha_envio){self::$fecha_envio = $fecha_envio;}
    final public static function setUsuariosIdUsuarios($usuarios_id_usuarios){self::$usuarios_id_usuarios = $usuarios_id_usuarios;}

    //metodo para obtener una notificación por su ID
    final public static function obtenerNotificacion()
    {
        try {
            $con = self::getConnection();
            $query = "CALL ConsultarNotificacion(:id)";
            $stmt = $con->prepare($query);
            $stmt->execute([':id' => self::getIdNotificaciones()]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            error_log("notificacionesModel::obtenerNotificacion -> " . $e);
            die(json_encode(responseHTTP::status500("Error al obtener la notificación.")));
        }
    }

    //metodo para obtener todas las notificaciones
    final public static function obtenerTodasNotificaciones()
    {
        try {
            $con = self::getConnection();
            $query = "CALL ConsultarTodasNotificaciones()";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            error_log("notificacionesModel::obtenerTodasNotificaciones -> " . $e);
            die(json_encode(responseHTTP::status500("Error al obtener todas las notificaciones.")));
        }
    }

    //metodo para guardar una nueva notificación
    final public static function guardarNotificacion()
    {
        try {
            $con = self::getConnection();
            $query = "CALL RegistrarNotificacion(:mensaje, :fecha_envio, :usuario_id)";
            $stmt = $con->prepare($query);
            $stmt->execute([
                ':mensaje' => self::getMensaje(),
                ':fecha_envio' => self::getFechaEnvio(),
                ':usuario_id' => self::getUsuariosIdUsuarios(),
            ]);

            if ($stmt->rowCount() > 0) {
                return responseHTTP::status200('Notificación registrada exitosamente.');
            } else {
                return responseHTTP::status500('Error al registrar la notificación.');
            }
        } catch (\PDOException $e) {
            error_log('notificacionesModel::guardarNotificacion -> ' . $e);
            die(json_encode(responseHTTP::status500("Error al registrar la notificación.")));
        }
    }

    //metodo para actualizar una notificación existente
    final public static function actualizarNotificacion()
    {
        try {
            $con = self::getConnection();
            $query = "CALL ActualizarNotificacion(:id, :mensaje, :fecha_envio, :usuario_id)";
            $stmt = $con->prepare($query);
            $stmt->execute([
                ':id' => self::getIdNotificaciones(),
                ':mensaje' => self::getMensaje(),
                ':fecha_envio' => self::getFechaEnvio(),
                ':usuario_id' => self::getUsuariosIdUsuarios(),
            ]);

            if ($stmt->rowCount() > 0) {
                return responseHTTP::status200('Notificación actualizada exitosamente.');
            } else {
                return responseHTTP::status500('Error al actualizar la notificación.');
            }
        } catch (\PDOException $e) {
            error_log('notificacionesModel::actualizarNotificacion -> ' . $e);
            die(json_encode(responseHTTP::status500("Error al actualizar la notificación.")));
        }
    }

    //metodo para eliminar una notificación por su ID
    final public static function eliminarNotificacion()
    {
        try {
            $con = self::getConnection();
            $query = "CALL EliminarNotificacion(:id)";
            $stmt = $con->prepare($query);
            $stmt->execute([':id' => self::getIdNotificaciones()]);

            if ($stmt->rowCount() > 0) {
                return responseHTTP::status200('Notificación eliminada exitosamente.');
            } else {
                return responseHTTP::status500('Error al eliminar la notificación.');
            }
        } catch (\PDOException $e) {
            error_log('notificacionesModel::eliminarNotificacion -> ' . $e);
            die(json_encode(responseHTTP::status500("Error al eliminar la notificación.")));
        }
    }
}