<?php
namespace App\DAO;

use App\Database\Database;
use App\Entity\Enrollment;
use App\Entity\DocumentCourse;
use App\Entity\VideoCourse;
use App\Entity\Category;
use App\Entity\User;

class EnrollmentDAO {
    private \PDO $con;

    public function __construct() {
        $this->con = Database::getInstance()->getConnection();
    }

    private function mapRowToEnrollment(array $row): Enrollment {
        $category = new Category($row['category_name'], $row['category_description'],$row['category_id'],);
        $teacher = new User($row['teacher_id'], $row['teacher_name'], null, $row['teacher_email'], 'teacher', $row['status']);
        if ($row['type'] === 'document') {
            $course = new DocumentCourse($row['course_id'], $row['title'], $row['description'], $row['content'], $category, $teacher, []);
        } else {
            $course = new VideoCourse($row['course_id'], $row['title'], $row['description'], $row['content'], $category, $teacher, []);
        }

        $enrollmentDate = new \DateTime($row['enrollment_date']);
        $student = new User($row['student_id'], $row['student_username'], null, $row['student_email'], $row['student_role'], $row['student_status']);

        return new Enrollment($row['enrollment_id'], $course, $student, $enrollmentDate);
    }

    public function getAllEnrollments(): array {
        $query = "SELECT * FROM courseCategoryUserEnrollment";
        $stmt = $this->con->query($query);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $enrollments = [];
        foreach ($rows as $row) {
            $enrollments[] = $this->mapRowToEnrollment($row);
        }
        return $enrollments;
    }

    public function getEnrollmentById(int $id): ?Enrollment {
        $query = "select * from courseCategoryUserEnrollment";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':enrollment_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $this->mapRowToEnrollment($row);
        }
        return null;
    }

    public function saveEnrollment(Enrollment $enrollment): bool {
        $stmt = $this->con->prepare("INSERT INTO Enrollments (user_id, course_id, enrollment_date) VALUES (:user_id, :course_id, :enrollment_date)");
        return $stmt->execute([
            'user_id' => $enrollment->user->getId(),
            'course_id' => $enrollment->course->getId(),
            'enrollment_date' => $enrollment->enrollmentDate->format('Y-m-d H:i:s')
        ]);
    }

    public function updateEnrollment(Enrollment $enrollment): bool {
        $stmt = $this->con->prepare("UPDATE Enrollments SET user_id = :user_id, course_id = :course_id, enrollment_date = :enrollment_date WHERE enrollment_id = :enrollment_id");
        return $stmt->execute([
            'enrollment_id' => $enrollment->id,
            'user_id' => $enrollment->user->getId(),
            'course_id' => $enrollment->course->getId(),
            'enrollment_date' => $enrollment->enrollmentDate->format('Y-m-d H:i:s')
        ]);
    }

    public function deleteEnrollment(int $id): bool {
        $stmt = $this->con->prepare("DELETE FROM Enrollments WHERE enrollment_id = :enrollment_id");
        return $stmt->execute(['enrollment_id' => $id]);
    }
}
