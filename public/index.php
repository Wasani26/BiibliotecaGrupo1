<?php
    use App\Config\errorlogs;
    use App\Config\responseHTTP;
    use App\Config\Security;

    require dirname(__DIR__) . '\vendor\autoload.php';
   
    
    $url = explode('/',$_GET['route']);
    $route = $url[0];



   /* $file = dirname(__DIR__) . '/src/Routes/' . $url[0] . '.php'; */

    // lista de rutas permitidas
    $lista = ['auth', 'user','login','libros','Catalogo','admin','ListaPrestamo','CrearPrestamo','ActualizarPrestamo','ListaDevoluciones','Notificaciones','Biblio','category']; // lista de rutas permitidas

    $caso = '';
    $caso  = filter_input(INPUT_GET,"caso");
  
    
    errorlogs::activa_error_logs(); //activamos los errors    
    if(isset($_GET['route'])){
        if(in_array($url[0], $lista)){
            //echo "La ruta no existe";
            //echo json_encode(responseHTTP::status200('La ruta ['.$file.'] no existe!'));
            //error_log("Esto es una prueba de error...");
           //header(‘HTTP/1.1 404 Not Found’);
            //exit; //finalizamos la ejecución
            $file = '';
            if ($caso != "") {
                $file = dirname(__DIR__) . '/src/Routes/' . $url[0] . '.php';
            } else{
                $file = dirname(__DIR__) . '/src/Views/' . $url[0] . '.php'; 
            }

        }
        // Si la vista no existe
        else {
            $file = dirname(__DIR__) . '/Src/Views/' . $url[0];
            $res = responseHTTP::status200('La ruta '. $file .' no existe.');
            echo json_encode($res);
            error_log($res['message']);
            exit;
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
 

?>
