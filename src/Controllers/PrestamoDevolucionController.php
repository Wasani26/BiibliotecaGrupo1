<?php

namespace App\Controllers;

use App\Config\responseHTTP;
use App\Config\Security;
use App\Models\PrestamoDevolucionModel;

class PrestamoDevolucionController
{
    private $method;
    private $route;
    private $params;
    private $data;
    private $headers;

    // Expresiones regulares
    private static $validar_numero = '/^[0-9]+$/';
    private static $validar_fecha = '/^\d{4}-\d{2}-\d{2}$/'; // Formato Año-Mes-Dia

    public function __construct($method, $route, $params, $data, $headers)
    {
        $this->method = $method;
        $this->route = $route;
        $this->params = $params;
        $this->data = $data;
        $this->headers = $headers;
    }

    // Método para registrar un prestamo
    final public function postPrestamo($endpoint)
    {
        if ($this->method == 'post' && $endpoint == $this->route) {
            // Validar JWT si es necesario
            // Security::validateTokenJwt($this->headers, Security::secretKey());

            if (empty($this->data['Fecha_prestamo']) || empty($this->data['Libros_Id_Libros']) || empty($this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Todos los campos son requeridos.'));
            } else if (!preg_match(self::$validar_fecha, $this->data['Fecha_prestamo'])) {
                echo json_encode(responseHTTP::status400('Formato de Fecha de prestamo invalido.'));
            } else if (!preg_match(self::$validar_numero, $this->data['Libros_Id_Libros']) || !preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Los IDs de libros y usuarios deben ser solo numeros.'));
            } else {
                new PrestamoDevolucionModel($this->data);
                echo json_encode(PrestamoDevolucionModel::registrarPrestamo());
            }
            exit;
        }
    }

    // Método para registrar una devolución
    final public function postDevolucion($endpoint)
    {
        if ($this->method == 'post' && $endpoint == $this->route) {
            // Validar JWT si es necesario
            // Security::validateTokenJwt($this->headers, Security::secretKey());

            if (empty($this->data['Fecha_devolucion']) || empty($this->data['Historial_Prestamos_Id_Historial_Prestamos']) || empty($this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Todos los campos son requeridos.'));
            } else if (!preg_match(self::$validar_fecha, $this->data['Fecha_devolucion'])) {
                echo json_encode(responseHTTP::status400('Formato de Fecha de devolucion invalido.'));
            } else if (!preg_match(self::$validar_numero, $this->data['Historial_Prestamos_Id_Historial_Prestamos']) || !preg_match(self::$validar_numero, $this->data['Usuarios_Id_Usuarios'])) {
                echo json_encode(responseHTTP::status400('Los IDs de préstamo y usuarios deben ser solo numeros.'));
            } else {
                new PrestamoDevolucionModel($this->data);
                echo json_encode(PrestamoDevolucionModel::registrarDevolucion());
            }
            exit;
        }
    }
}