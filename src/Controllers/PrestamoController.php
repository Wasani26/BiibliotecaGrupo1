<?php

namespace App\Controllers;
use App\Models\PrestamoModel;
use App\Config\responseHTTP;
use App\Config\Security;
class PrestamoController{
    private $method;
    private $route;
    private $params;
    private $data;
    private $headers;

    private static $validar_numero = '/^[0-9]+$/'; //validamos numeros (0-9)
    private static $validar_fecha = '/^\d{4}-\d{2}-\d{2}$/'; //validamos formato de fecha YYYY-MM-DD

    public function __construct($method, $route, $params, $data, $headers)
    {
        $this->method = $method;
        $this->route = $route;
        $this->params = $params;
        $this->data = $data;
        $this->headers = $headers;
    }

    // (CRUD)
    final public function crearPrestamo()
    {
        if ($this->method == 'POST' && $this->route == 'Prestamos/crear') {
            // Validar JWT (opcional, descomentar si es necesario)
            // Security::validateTokenJwt($this->headers, Security::secretKey());

            // Validar campos requeridos
            if (empty($this->data['Fecha_prestamo']) || empty($this->data['Libros_Id_Libros']) || empty($this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Los campos Fecha_prestamo, Libros_Id_Libros y Usuarios_Id_Usuarios son requeridos.'));
                exit;
            }

            // Validar formato de fecha
            if (!preg_match(self::$validar_fecha, $this->data['Fecha_prestamo'])) {
                echo json_encode(responseHTTP::status400('El campo Fecha_prestamo debe tener el formato YYYY-MM-DD.'));
                exit;
            }

            // Validar que Libros_Id_Libros y Usuarios_Id_Usuarios sean números
            if (!preg_match(self::$validar_numero, $this->data['Libros_Id_Libros']) || !preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Los campos Libros_Id_Libros y Usuarios_Id_Usuarios deben ser números.'));
                exit;
            }

            $model = new PrestamoModel();
            $id = $model->insert($this->data);
            if ($id) {
                $this->obtenerPrestamo($id); // Devolver el prestamo creado
            } else {
                echo json_encode(responseHTTP::status500('Error al crear el prestamo.'));
            }
            exit;
        } else {
            echo json_encode(responseHTTP::status404('metodo no permitido para esta ruta.'));
            exit;
        }
    }

    final public function listarPrestamos()
    {
        if ($this->method == 'GET' && $this->route == 'Prestamos/listar') {
            // Validar JWT (opcional)
            // Security::validateTokenJwt($this->headers, Security::secretKey());

            $model = new PrestamoModel();
            $prestamos = $model->getAll();
            echo json_encode(responseHTTP::status200('Lista de prestamos', $prestamos));
            exit;
        } else {
            echo json_encode(responseHTTP::status404('metodo no permitido para esta ruta.'));
            exit;
        }
    }

    final public function obtenerPrestamo($id)
    {
        if ($this->method == 'GET' && $this->route == 'Prestamos/obtener' && isset($this->params[1]) && preg_match(self::$validar_numero, $this->params[1])) {
            // Validar JWT (opcional)
            // Security::validateTokenJwt($this->headers, Security::secretKey());

            $model = new PrestamoModel();
            $prestamo = $model->getById($this->params[1]);
            if ($prestamo) {
                echo json_encode(responseHTTP::status200('Informacion del prestamo', $prestamo));
            } else {
                echo json_encode(responseHTTP::status404('Prestamo no encontrado.'));
            }
            exit;
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta para obtener el prestamo.'));
            exit;
        }
    }

    final public function actualizarPrestamo($id)
    {
        if ($this->method == 'PUT' && $this->route == 'Prestamos/actualizar' && isset($this->params[1]) && preg_match(self::$validar_numero, $this->params[1])) {
            // Validar JWT (opcional)
            // Security::validateTokenJwt($this->headers, Security::secretKey());

            // Validar que al menos un campo se esté actualizando
            if (empty($this->data)) {
                echo json_encode(responseHTTP::status400('Debe proporcionar al menos un campo para actualizar el préstamo.'));
                exit;
            }

            // Validar formato de fecha si se proporciona
            if (isset($this->data['Fecha_prestamo']) && !preg_match(self::$validar_fecha, $this->data['Fecha_prestamo'])) {
                echo json_encode(responseHTTP::status400('El campo Fecha_prestamo debe tener el formato YYYY-MM-DD.'));
                exit;
            }
            if (isset($this->data['Fecha_devolucion']) && !preg_match(self::$validar_fecha, $this->data['Fecha_devolucion'])) {
                echo json_encode(responseHTTP::status400('El campo Fecha_devolucion debe tener el formato YYYY-MM-DD.'));
                exit;
            }

            // Validar que Libros_Id_Libros y Usuarios_Id_Usuarios sean números si se proporcionan
            if (isset($this->data['Libros_Id_Libros']) && !preg_match(self::$validar_numero, $this->data['Libros_Id_Libros'])) {
                echo json_encode(responseHTTP::status400('El campo Libros_Id_Libros debe ser un número.'));
                exit;
            }
            if (isset($this->data['Usuarios_Id_Usuarios']) && !preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('El campo Usuarios_Id_Usuarios debe ser un número.'));
                exit;
            }

            $model = new PrestamoModel();
            $resultado = $model->update($this->params[1], $this->data);
            if ($resultado) {
                $this->obtenerPrestamo($this->params[1]); // Devolver el préstamo actualizado
            } else {
                echo json_encode(responseHTTP::status404('Préstamo no encontrado o error al actualizar.'));
            }
            exit;
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta para actualizar el préstamo.'));
            exit;
        }
    }

    final public function eliminarPrestamo($id)
    {
        if ($this->method == 'DELETE' && $this->route == 'Prestamos/eliminar' && isset($this->params[1]) && preg_match(self::$validar_numero, $this->params[1])) {
            // Validar JWT (opcional)
            // Security::validateTokenJwt($this->headers, Security::secretKey());

            $model = new PrestamoModel();
            $resultado = $model->delete($this->params[1]);
            if ($resultado) {
                echo json_encode(responseHTTP::status200('Préstamo eliminado exitosamente.'));
            } else {
                echo json_encode(responseHTTP::status404('Préstamo no encontrado o error al eliminar.'));
            }
            exit;
        } else {
            echo json_encode(responseHTTP::status400('Solicitud incorrecta para eliminar el préstamo.'));
            exit;
        }
    }

}