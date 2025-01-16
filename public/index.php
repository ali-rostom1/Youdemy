<?php
    //NAMESPACES NEEDED
    use App\Controller\AdminController;
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

    require_once "../vendor/autoload.php"; //PSR-4 AUTOLOADER
    
    //LOADING ENVIROMENT VARIABLES    
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    //INITIALIZING ROUTER
    $router = new Router();

    //CALLING CONTROLLERS
    $courseController = new CourseController();
    $authController = new AuthController();
    $adminController = new AdminController();




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
    $router->add("/logout",function () use ($authController){
        $authController->logout();
    });
    $router->add("/admin/dashboard",function() use ($adminController){
        $adminController->index();
    });
    $router->add("/admin/users",function() use ($adminController){
        $adminController->users();
    });



    
    $requestedURI = $_SERVER["REQUEST_URI"];// GETTING THE REQUEST URI
    $requestedURI = parse_url($requestedURI,PHP_URL_PATH); // removing the get queries

    //DISPATCHING REQUEST BASED ON ROUTES ADDED
    $router->dispatch($requestedURI);


    

