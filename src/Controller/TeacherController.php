<?php

namespace App\Controller;

use App\DAO\CategoryDAO;
use App\DAO\CourseDAO;
use App\DAO\EnrollmentDAO;
use App\DAO\StatisticsDAO;
use App\DAO\TagDAO;
use App\Entity\Enrollment;
use App\Service\Authentification;

class TeacherController
{
    private CourseDAO $courseDAO;
    private CategoryDAO $categoryDAO;
    private Authentification $auth;
    private TagDAO $tagDAO;
    private EnrollmentDAO $enrollmentDAO;
    private StatisticsDAO $statisticsDAO;

    public function __construct()
    {
        $this->courseDAO = new CourseDAO();
        $this->categoryDAO = new CategoryDAO();
        $this->auth = new Authentification();
        $this->tagDAO = new TagDAO();
        $this->enrollmentDAO = new EnrollmentDAO();
        $this->statisticsDAO = new StatisticsDAO();
    }

    public function dashboard() : void
    {
        if (!$this->auth->getCurrentUser() || !$this->auth->isTeacher()) {
            header("location: /authentification");
            exit;
        }



        $teacher = $this->auth->getCurrentUser();

        $totalCourses = $this->statisticsDAO->totalCoursesTeacher($teacher);
        $totalStudents = $this->statisticsDAO->totalStudentsTeacher($teacher);
        $totalEnrollments = $this->statisticsDAO->totalEnrollmentsTeacher($teacher);
        $recentEnrollments = $this->statisticsDAO->recentEnrollments($teacher);

        include "../src/Views/teacher/teacherDashboard.php";
    }

    public function createCourse() : void
    {
        if (!$this->auth->getCurrentUser() || !$this->auth->isTeacher()) {
            header("location: /authentification");
            exit;
        }

        include "../src/Views/createCourse.php";
    }

    public function manageCourses() : void
    {
        if (!$this->auth->getCurrentUser() || !$this->auth->isTeacher()) {
            header("location: /authentification");
            exit;
        }

        $teacher = $this->auth->getCurrentUser();
        $courses = $this->courseDAO->getCoursesByTeacher($teacher);
        $courseDataJson = json_encode($courses);

        include "../src/Views/manageCourses.php";
    }
}