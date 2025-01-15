<?php

    namespace App\Controller;

    use App\DAO\CategoryDAO;
    use App\DAO\CourseDAO;

    class CourseController{

        private CourseDAO $courseDAO;
        private CategoryDAO $categoryDAO;

        public function __construct()
        {
            $this->courseDAO = new CourseDAO();
            $this->categoryDAO = new CategoryDAO();
        }
        public function index() : void
        {
            $categories = array_slice($this->categoryDAO->getAllCategories(), 0, 3); 
            $courses = array_slice($this->courseDAO->getAllCourses(), 0, 3);
            include "../src/Views/home.php";
        }

    }