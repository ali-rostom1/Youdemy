<?php 

namespace App\DAO;

use App\Database\Database;
use App\Entity\Enrollment;
use App\Entity\User;

class StatisticsDAO{

    private \PDO $con;


    public function __construct()
    {
        $this->con = Database::getInstance()->getConnection();
    }
    // teacher Statistics
    public function totalCoursesTeacher(User $teacher) : int
    {
        $sql = "SELECT COUNT(*) as TOTAL FROM courses WHERE teacher_id = :teacher_id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['TOTAL'];
    }
    public function totalStudentsTeacher(User $teacher) : int
    {
        $sql = "SELECT COUNT(DISTINCT student_id) as TOTAL FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['TOTAL'];
    }
    public function totalEnrollmentsTeacher(User $teacher) : int
    {
        $sql = "SELECT COUNT(*) as TOTAL FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['TOTAL'];
    }
    public function recentEnrollments(User $teacher) : array
    {
        $sql = "SELECT * FROM coursecategoryuserenrollment WHERE teacher_id = :teacher_id ORDER BY enrollment_date DESC LIMIT 3";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacher->id,\PDO::PARAM_INT);
        $stmt->execute();

        $enrollments = [];
        $enrollmentDAO = new EnrollmentDAO();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $enrollments[] = $enrollmentDAO->mapRowToEnrollment($row);
        }
        return $enrollments;


    }

}