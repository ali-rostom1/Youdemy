<?php

use App\Controller\CourseController;
use App\DAO\CategoryDAO;
use App\DAO\CourseDAO;
use App\DAO\EnrollmentDAO;
use App\DAO\TagDAO;
use App\DAO\UserDAO;
use App\Entity\Tag;
use App\Router;
    use Dotenv\Dotenv;

    require_once "../vendor/autoload.php";
    
    //LOADING ENVIROMENT VARIABLES    
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();


    $router = new Router();

    $courseController = new CourseController();

    //ADDING ROUTES
    $router->add("/",function() use ($courseController){
        $courseController->index();
    });
    $router->add("/catalogue",function() use ($courseController){
        $courseController->catalogue();
    });
    
    $requestedURI = $_SERVER["REQUEST_URI"];
    $requestedURI = parse_url($requestedURI,PHP_URL_PATH); // removing the get queries

    //DISPATCHING REQUEST BASED ON ROUTES ADDED
    $router->dispatch($requestedURI);


    

