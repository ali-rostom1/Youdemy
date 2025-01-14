<?php
    use App\Router;
    use Dotenv\Dotenv;

    require_once "../vendor/autoload.php";
    
    //LOADING ENVIROMENT VARIABLES    
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();


    $router = new Router();


    //ADDING ROUTES
    $router->add("/",function(){
       echo "hello"; 
    });
    $router->add("/login",function(){
        echo "login";
    });
    
    $requestedURI = $_SERVER["REQUEST_URI"];

    //DISPATCHING REQUEST BASED ON ROUTES ADDED
    $router->dispatch($requestedURI);





