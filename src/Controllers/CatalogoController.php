<?php
namespace App\Controllers;
namespace App\Config\responseHTTP;
namespace App\Controllers;
use App\Model\CatalogoController;

use App\Model\CatalogoModel;

class CatalogController {
    private $catalogoModel;

    public function __construct($db) {
        $this->catalogoModel = new CatalogoModel($db);
    }

    public function listarLibros() {
        $libros = $this->catalogoModel->obtenerTodosLosLibros();
        header('Content-Type: application/json');
        echo json_encode($libros);
    }

    public function obtenerLibroPorId($id) {
        $libro = $this->catalogoModel->obtenerLibroPorId($id);
        header('Content-Type: application/json');
        if ($libro) {
            echo json_encode($libro);
        } else {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Libro no encontrado']);
        }
    }

    public function buscarLibros() {
        $termino = isset($_GET['q']) ? $_GET['q'] : '';
        if (!empty($termino)) {
            $resultados = $this->catalogoModel->buscarLibros($termino);
            header('Content-Type: application/json');
            echo json_encode($resultados);
        } else {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Por favor, proporciona un término de búsqueda']);
        }
    }
}

// ruta de catalogo //
$url = explode('/', $_GET['route'] ?? '');
    $route = $url[0] ?? '';

    $listaRutasGenerales = ['auth', 'user', 'login', 'libros', 'catalogo', 'registrer']; // Asegúrate de incluir 'catalogo'

    errorlogs::activa_error_logs();

    if (isset($_GET['route'])) {
        if (!in_array($route, $listaRutasGenerales)) {
            echo json_encode(responseHTTP::status200('La ruta no existe!')); // Considera usar 404
            exit;
        }

        $file = dirname(__DIR__) . '/src/Routes/' . $route . '.php';
        if (file_exists($file) && is_readable($file)) {
            require $file;
            exit;
        } else {
            echo json_encode(responseHTTP::status200('El archivo de ruta no existe o no es legible!')); // Considera usar 404
            exit;
        }

    } else {
        echo "no existe la variable route";
    }

?>
