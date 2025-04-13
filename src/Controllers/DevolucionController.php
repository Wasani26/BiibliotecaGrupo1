<?php
namespace App\Controllers;
use App\Models\DevolucionModel;
use App\Config\responseHTTP;
use App\Config\Security;
class DevolucionController{
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

// (CRUD)

final public function crearDevolucion()
{
    if ($this->method == 'POST' && $this->route == 'Devoluciones/crear') {
        // Validar JWT (opcional)
        // Security::validateTokenJwt($this->headers, Security::secretKey());

        // Validar campos requeridos
        if (empty($this->data['Fecha_devolucion']) || empty($this->data['Historial_Prestamos_Id_Historial_Prestamos']) || empty($this->data['Usuarios_Id_Usuarios'])) {
            echo json_encode(responseHTTP::status400('Los campos Fecha_devolucion, Historial_Prestamos_Id_Historial_Prestamos y Usuarios_Id_Usuarios son requeridos.'));
            exit;
        }

        // Validar formato de fecha
        if (!preg_match(self::$validar_fecha, $this->data['Fecha_devolucion'])) {
            echo json_encode(responseHTTP::status400('El campo Fecha_devolucion debe tener el formato YYYY-MM-DD.'));
            exit;
        }

        // Validar que los IDs sean numeros
        if (!preg_match(self::$validar_numero, $this->data['Historial_Prestamos_Id_Historial_Prestamos']) || !preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
            echo json_encode(responseHTTP::status400('Los campos Historial_Prestamos_Id_Historial_Prestamos y Usuarios_Id_Usuarios deben ser números.'));
            exit;
        }

        $model = new DevolucionModel();
        $id = $model->insert($this->data);
        if ($id) {
            $this->obtenerDevolucion($id); // Devolver la devolución creada
        } else {
            echo json_encode(responseHTTP::status500('Error al crear la devolución.'));
        }
        exit;
    } else {
        echo json_encode(responseHTTP::status404('Método no permitido para esta ruta.'));
        exit;
    }
}

final public function listarDevoluciones()
{
    if ($this->method == 'GET' && $this->route == 'Devoluciones/listar') {
        // Validar JWT (opcional)
        // Security::validateTokenJwt($this->headers, Security::secretKey());

        $model = new DevolucionModel();
        $devoluciones = $model->getAll();
        echo json_encode(responseHTTP::status200('Lista de devoluciones', $devoluciones));
        exit;
    } else {
        echo json_encode(responseHTTP::status404('Metodo no permitido para esta ruta.'));
        exit;
    }
}

final public function obtenerDevolucion($id)
{
    if ($this->method == 'GET' && $this->route == 'Devoluciones/obtener' && isset($this->params[1]) && preg_match(self::$validar_numero, $this->params[1])) {
        // Validar JWT (opcional)
        // Security::validateTokenJwt($this->headers, Security::secretKey());

        $model = new DevolucionModel();
        $devolucion = $model->getById($this->params[1]);
        if ($devolucion) {
            echo json_encode(responseHTTP::status200('Información de la devolucion', $devolucion));
        } else {
            echo json_encode(responseHTTP::status404('Devolucion no encontrada.'));
        }
        exit;
    } else {
        echo json_encode(responseHTTP::status400('Solicitud incorrecta para obtener la devolucion.'));
        exit;
    }
}

final public function actualizarDevolucion($id)
{
    if ($this->method == 'PUT' && $this->route == 'Devoluciones/actualizar' && isset($this->params[1]) && preg_match(self::$validar_numero, $this->params[1])) {
        // Validar JWT (opcional)
        // Security::validateTokenJwt($this->headers, Security::secretKey());

        // Validar que al menos un campo se esté actualizando
        if (empty($this->data)) {
            echo json_encode(responseHTTP::status400('Debe proporcionar al menos un campo para actualizar la devolución.'));
            exit;
        }

        // Validar formato de fecha si se proporciona
        if (isset($this->data['Fecha_devolucion']) && !preg_match(self::$validar_fecha, $this->data['Fecha_devolucion'])) {
            echo json_encode(responseHTTP::status400('El campo Fecha_devolucion debe tener el formato YYYY-MM-DD.'));
            exit;
        }

        // Validar que los IDs sean numeros si se proporcionan
        if (isset($this->data['Historial_Prestamos_Id_Historial_Prestamos']) && !preg_match(self::$validar_numero, $this->data['Historial_Prestamos_Id_Historial_Prestamos'])) {
            echo json_encode(responseHTTP::status400('El campo Historial_Prestamos_Id_Historial_Prestamos debe ser un número.'));
            exit;
        }
        if (isset($this->data['Usuarios_Id_Usuarios']) && !preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
            echo json_encode(responseHTTP::status400('El campo Usuarios_Id_Usuarios debe ser un número.'));
            exit;
        }

        $model = new DevolucionModel();
        $resultado = $model->update($this->params[1], $this->data);
        if ($resultado) {
            $this->obtenerDevolucion($this->params[1]); // Devolver la devolución actualizada
        } else {
            echo json_encode(responseHTTP::status404('Devolucion no encontrada o error al actualizar.'));
        }
        exit;
    } else {
        echo json_encode(responseHTTP::status400('Solicitud incorrecta para actualizar la devolución.'));
        exit;
    }
}

final public function eliminarDevolucion($id)
{
    if ($this->method == 'DELETE' && $this->route == 'Devoluciones/eliminar' && isset($this->params[1]) && preg_match(self::$validar_numero, $this->params[1])) {
        // Validar JWT (opcional)
        // Security::validateTokenJwt($this->headers, Security::secretKey());

        $model = new DevolucionModel();
        $resultado = $model->delete($this->params[1]);
        if ($resultado) {
            echo json_encode(responseHTTP::status200('Devolución eliminada exitosamente.'));
        } else {
            echo json_encode(responseHTTP::status404('Devolución no encontrada o error al eliminar.'));
        }
        exit;
    } else {
        echo json_encode(responseHTTP::status400('Solicitud incorrecta para eliminar la devolución.'));
        exit;
    }
}
}