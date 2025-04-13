<?php
    use App\Config\errorlogs;
    use App\Config\responseHTTP;
    use App\Config\Security;
    use App\Controllers\LibrosController;
    use App\Config\TokenJwt;
    use App\Models\LibrosModel;

    require dirname(__DIR__) . '/src/Controllers/LibrosController.php'; // Ajusta la ruta según tu estructura
    require dirname(__DIR__) . '\vendor\autoload.php';

    $url = explode('/',$_GET['route']);

    $lista = ['auth', 'user','login', 'libros','Prestamos','Devoluciones','Notificaciones','']; // lista de rutas permitidas
    $file = dirname(__DIR__) . '/src/Routes/' . $url[0] . '.php'; 
    $controller = new LibrosController(new LibrosModel($db), new TokenJwt());
    
    //caso libros//
    if (isset($controller) && is_object($controller)) {
    switch ($_SERVER['REQUEST_METHOD']) {  
        case 'GET':  
            if ($url[0] === 'libros') {  
                $controller->obtenerLibros();  
            }  
            break;  
        case 'POST':  
            if ($url[0] === 'libros') {  
                $controller->crearLibro(json_decode(file_get_contents("php://input"), true));  
            }  
            // Otras rutas para POST  
            break;
        }  
    }else{
        echo "Error: El controlador no está inicializado.";
    }

    /*$lista = ['auth', 'user','login','libros','registrer']; // lista de rutas permitidas
    $caso = '';
    $caso  = filter_input(INPUT_GET,"caso");
    $file = '';
    if($caso != ""){
        $file = dirname(__DIR__) . '/src/Routes/' . $url[0] . '.php'; 
    }else{
        $file = dirname(__DIR__) . '/src/Views/' . $url[0] . '.php'; 
    }*/



    errorlogs::activa_error_logs(); //activamos los errors    
    if(isset($_GET['route'])){
        if(!in_array($url[0], $lista)){
            //echo "La ruta no existe";
            echo json_encode(responseHTTP::status200('La ruta no existe!'));
            //error_log("Esto es una prueba de error...");
           //header(‘HTTP/1.1 404 Not Found’);
            exit; //finalizamos la ejecución
        }  
        
        //validamos que el archivo exista y que es legible
        if(!file_exists($file) || !is_readable($file)){
            //echo "El archivo no existe o no es legible";
            echo json_encode(responseHTTP::status200('El archivo no existe o no es legible!'));
            //error_log("Esto es una prueba de error...");
        }else{
            require $file;
            exit;
        }

        //echo "existe la variable route";
    }else{
        echo "no existe la variable route";
    }
 

?