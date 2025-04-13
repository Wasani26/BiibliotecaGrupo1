<?php
namespace App\Controllers;
use App\Models\NotificacionesModel;
use App\Config\responseHTTP;
use App\Config\Security;

class NotificacionesController{
    private $method;
    private $route;
    private $params;
    private $data;
    private $headers;

    private static $validar_numero = '/^[0-9]+$/'; //validamos números (0-9)
    private static $validar_texto = '/^[a-zA-Z0-9\s.,!?¡¿()\'"#$%&*-+\/:;<=>@\[\]\\\\^_`{|}~]+$/u'; //validamos texto con caracteres especiales comunes
    private static $validar_fecha = '/^\d{4}-\d{2}-\d{2}$/'; //validamos formato de fecha YYYY-MM-DD

    public function __construct($method, $route, $params, $data, $headers)
    {
        $this->method = $method;
        $this->route = $route;
        $this->params = $params;
        $this->data = $data;
        $this->headers = $headers;
    }

    final public function obtenerNotificacion($endpoint)
    {
        if ($this->method == 'get' && $endpoint == $this->route) {
            // Seguridad::validateTokenJwt($this->headers, Security::secretKey()); // Si necesitas validación JWT
            if (!empty($this->data['Id_Notificaciones']) && preg_match(self::$validar_numero, $this->data['Id_Notificaciones'])) {
                new notificacionesModel($this->data);
                echo json_encode(notificacionesModel::obtenerNotificacion());
            } else {
                echo json_encode(responseHTTP::status400('Se requiere el ID de la notificación y debe ser un número.'));
            }
            exit;
        }
    }

    final public function obtenerTodasNotificaciones($endpoint)
    {
        if ($this->method == 'get' && $endpoint == $this->route) {
            // Seguridad::validateTokenJwt($this->headers, Security::secretKey()); // Si necesitas validación JWT
            echo json_encode(notificacionesModel::obtenerTodasNotificaciones());
            exit;
        }
    }

    final public function guardarNotificacion($endpoint)
    {
        if ($this->method == 'post' && $endpoint == $this->route) {
            // Seguridad::validateTokenJwt($this->headers, Security::secretKey()); // Si necesitas validación JWT

            if (empty($this->data['Mensaje']) || empty($this->data['Fecha_envio']) || empty($this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Todos los campos son requeridos.'));
            } elseif (!preg_match(self::$validar_texto, $this->data['Mensaje'])) {
                echo json_encode(responseHTTP::status400('El mensaje contiene caracteres inválidos.'));
            } elseif (!preg_match(self::$validar_fecha, $this->data['Fecha_envio'])) {
                echo json_encode(responseHTTP::status400('El formato de la fecha de envío debe ser YYYY-MM-DD.'));
            } elseif (!preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('El ID de usuario debe ser un número.'));
            } else {
                new notificacionesModel($this->data);
                echo json_encode(notificacionesModel::guardarNotificacion());
            }
            exit;
        }
    }

    final public function actualizarNotificacion($endpoint)
    {
        if ($this->method == 'put' && $endpoint == $this->route) {
            // Seguridad::validateTokenJwt($this->headers, Security::secretKey()); // Si necesitas validación JWT

            if (empty($this->data['Id_Notificaciones']) || empty($this->data['Mensaje']) || empty($this->data['Fecha_envio']) || empty($this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Todos los campos son requeridos, incluyendo el ID de la notificación.'));
            } elseif (!preg_match(self::$validar_numero, $this->data['Id_Notificaciones'])) {
                echo json_encode(responseHTTP::status400('El ID de la notificación debe ser un número.'));
            } elseif (!preg_match(self::$validar_texto, $this->data['Mensaje'])) {
                echo json_encode(responseHTTP::status400('El mensaje contiene caracteres inválidos.'));
            } elseif (!preg_match(self::$validar_fecha, $this->data['Fecha_envio'])) {
                echo json_encode(responseHTTP::status400('El formato de la fecha de envío debe ser YYYY-MM-DD.'));
            } elseif (!preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('El ID de usuario debe ser un número.'));
            } else {
                new notificacionesModel($this->data);
                echo json_encode(notificacionesModel::actualizarNotificacion());
            }
            exit;
        }
    }

    final public function eliminarNotificacion($endpoint)
    {
        if ($this->method == 'delete' && $endpoint == $this->route) {
            // Seguridad::validateTokenJwt($this->headers, Security::secretKey()); // Si necesitas validación JWT

            if (!empty($this->data['Id_Notificaciones']) && preg_match(self::$validar_numero, $this->data['Id_Notificaciones'])) {
                new notificacionesModel($this->data);
                echo json_encode(notificacionesModel::eliminarNotificacion());
            } else {
                echo json_encode(responseHTTP::status400('Se requiere el ID de la notificación para eliminar y debe ser un número.'));
            }
            exit;
        }
    }
}