<?php
    //NAMESPACES NEEDED
    use App\Controller\AdminController;
    use App\Controller\AuthController;

    use App\Controller\DefaultController;
    use App\Controller\TeacherController;
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
    $defaultController = new DefaultController();
    $authController = new AuthController();
    $adminController = new AdminController();
    $teacherController = new TeacherController();



    //ADDING ROUTES
    $router->add("/",function() use ($defaultController){
        $defaultController->index();
    });
    $router->add("/catalogue",function() use ($defaultController){
        $defaultController->catalogue();
    });
    $router->add("/authentification",function() use ($authController){
        $authController->index();
    });
    $router->add("/login",function () use ($authController){
        $authController->login();
    });
    $router->add("/register",function () use ($authController){
        $authController->register();
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
    $router->add("/admin/courses",function() use ($adminController){
        $adminController->courses();
    });
    $router->add("/admin/category",function() use ($adminController){
        $adminController->category();
    });
    $router->add("/course/signup",function() use ($defaultController){
        $defaultController->courseSignUp();
    });
    $router->add("/myCourses",function() use ($defaultController){
        $defaultController->myCourses();
    });
    $router->add("/teacher/dashboard",function() use ($teacherController){
        $teacherController->dashboard();
    });
    $router->add("/teacher/courses",function() use ($teacherController){
        $teacherController->courses();
    });
    $router->add("/teacher/create-course",function() use ($teacherController){
        $teacherController->createCourse();
    });
    $router->add("/course/create",function() use ($teacherController){
        $teacherController->create();
    });
    $router->add("/course/update",function() use ($teacherController){
        $teacherController->update();
    });

    
    $requestedURI = $_SERVER["REQUEST_URI"];// GETTING THE REQUEST URI
    $requestedURI = parse_url($requestedURI,PHP_URL_PATH); // removing the get queries

    //DISPATCHING REQUEST BASED ON ROUTES ADDED
    $router->dispatch($requestedURI);


    

