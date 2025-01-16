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
        public function index() : void
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
        public function users() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $role = isset($_GET["role"]) ? $_GET["role"] : "";
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $perPage = 4;
            $users = !$term ?  $this->userDAO->getAllUsersPagination($page,$perPage,$role) : $this->userDAO->searchUsers($term);
            $totalUsers = $this->userDAO->getTotalUsers($role); 
            $totalPages = ceil($totalUsers/$perPage);
            include "../src/Views/admin/users.php";
        }
        public function courses() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $category = isset($_GET["category"]) ? $_GET["category"] : "";
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $perPage = 4;
            $courses = !$term ?  $this->courseDAO->getAllCoursesPagination($page,$perPage,$category) : $this->courseDAO->searchCourses($term);
            $categories = $this->categoryDAO->getAllCategories();
            $totalCourses = $this->courseDAO->getTotalCoursesCategory($category);
            $totalPages = ceil($totalCourses/$perPage);
            include "../src/Views/admin/courses.php";
        }
        public function category() : void
        {
            if(!$this->auth->isAdmin())
            {
                header("location: /");
                exit;
            }
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $term = isset($_GET["term"]) ? $_GET["term"] : "";
            $perPage = 2;
            $categories = !$term ?  $this->categoryDAO->getAllCategoryPagination($page,$perPage) : $this->categoryDAO->searchCategory($term);
            $totalCategories = $this->categoryDAO->getTotalCategory();
            $totalPages = ceil($totalCategories/$perPage);
            

            include "../src/Views/admin/category.php";
        }


    }