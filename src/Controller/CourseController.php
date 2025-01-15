<?php

    namespace App\Controller;

    use App\DAO\CategoryDAO;
    use App\DAO\CourseDAO;
    use App\Service\Authentification;

    class CourseController{

        private CourseDAO $courseDAO;
        private CategoryDAO $categoryDAO;
        private Authentification $auth;

        public function __construct()
        {
            $this->courseDAO = new CourseDAO();
            $this->categoryDAO = new CategoryDAO();
            $this->auth = new Authentification();
        }
        public function index() : void
        {
            if($this->auth->isAdmin()){
                header("location: /admin/dashboard");
                return;
            }
            $categories = array_slice($this->categoryDAO->getAllCategories(), 0, 3); 
            $courses = array_slice($this->courseDAO->getAllCourses(), 0, 3);
            include "../src/Views/home.php";
        }

    }