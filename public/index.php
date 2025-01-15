<?php

    use App\Controller\AuthController;
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
    $authController = new AuthController();

    //ADDING ROUTES
    $router->add("/",function() use ($courseController){
        $courseController->index();
    });
    $router->add("/catalogue",function() use ($courseController){
        $courseController->catalogue();
    });
    $router->add("/authentification",function() use ($authController){
        $authController->index();
    });
    $router->add("/login",function () use ($authController){
        $authController->login();
    });
    $router->add("/test",function(){
        $courseDAO = new CourseDAO();
    });
    
    $requestedURI = $_SERVER["REQUEST_URI"];
    $requestedURI = parse_url($requestedURI,PHP_URL_PATH); // removing the get queries

    //DISPATCHING REQUEST BASED ON ROUTES ADDED
    $router->dispatch($requestedURI);


    

