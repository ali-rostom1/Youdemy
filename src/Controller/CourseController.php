<?php

    namespace App\Controller;

    use App\DAO\CategoryDAO;
    use App\DAO\CourseDAO;
    use App\DAO\TagDAO;
    use App\Service\Authentification;

    class CourseController{

        private CourseDAO $courseDAO;
        private CategoryDAO $categoryDAO;
        private Authentification $auth;
        private TagDAO $tagDAO;

        public function __construct()
        {
            $this->courseDAO = new CourseDAO();
            $this->categoryDAO = new CategoryDAO();
            $this->auth = new Authentification();
            $this->tagDAO = new TagDAO();
        }
        public function index() : void
        {
            if($this->auth->isAdmin()){
                header("location: /admin/dashboard");
                return;
            }
            $categories = array_slice($this->categoryDAO->getAllCategories(), 0, 3); 
            $courses = array_slice($this->courseDAO->getAllCourses(), 0, 3);
            $isLogged = $this->auth->isAuthenticated();
            include "../src/Views/home.php";
        }
        public function catalogue() : void
        {
            if($this->auth->isAdmin())
            {
                header("location: /admin/dashboard");
                exit;
            }
            $categories = $this->categoryDAO->getAllCategories();
            $courses = $this->courseDAO->getAllCourses();
            $tags = $this->tagDAO->getAllTags();
            $documentCoursesCount = $this->courseDAO->getDocumentCoursesCount();
            $videoCoursesCount = $this->courseDAO->getVideoCoursesCount();
            $isLogged = $this->auth->isAuthenticated();
            include "../src/Views/catalogue.php";
        }
    }