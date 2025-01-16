<?php 

    namespace App\Controller;

    use App\DAO\CategoryDAO;
    use App\DAO\CourseDAO;
use App\DAO\EnrollmentDAO;
use App\DAO\TagDAO;
    use App\DAO\UserDAO;
    use App\Service\Authentification;

    class AdminController{
        private Authentification $auth;
        private CourseDAO $courseDAO;
        private CategoryDAO $categoryDAO;
        private TagDAO $tagDAO;
        private UserDAO $userDAO;
        private EnrollmentDAO $enrollmentDAO;

        public function __construct()
        {
            $this->auth = new Authentification();
            $this->courseDAO = new CourseDAO();
            $this->categoryDAO = new CategoryDAO();
            $this->tagDAO = new TagDAO();
            $this->userDAO = new UserDAO();
            $this->enrollmentDAO = new EnrollmentDAO();
        }
        public function index()
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $totalStudents = $this->userDAO->getAllStudentsCount();
            $totalTeachers = $this->userDAO->getAllTeachersCount();
            $totalCourses  = $this->courseDAO->getTotalCourses();
            $totalEnrollments = $this->enrollmentDAO->getTotalEnrollments();
            include "../src/Views/admin/dashboard.php";
        }



    }