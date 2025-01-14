<?php
    namespace App\DAO;

    use App\Database\Database;
    use App\Entity\Category;
    use App\Entity\Course;
    use App\Entity\DocumentCourse;
    use App\Entity\Tag;
    use App\Entity\VideoCourse;
    use App\Entity\User;

    class CourseDAO{
        private \PDO $con;

        public function __construct(){
            $this->con = Database::getInstance()->getConnection();
        }
        // helpers
        private function mapRowToCourse(array $row) : Course
        {
            $category = new Category($row["category_name"],$row["category_description"],$row["category_id"]);
            $teacher = new User($row["teacher_id"],$row["teacher_name"],NULL,$row["teacher_email"],"teacher",$row["status"]);
            $tags = $this->getTagsByCourseId($row['course_id']);

            if($row["type"] === "document")
            {
                return new DocumentCourse($row["course_id"],$row["title"],$row["description"],$row["content"],$category,$teacher,$tags);
            }else{
                return new VideoCourse($row["course_id"],$row["title"],$row["description"],$row["content"],$category,$teacher,$tags);
            }


        }
        private function getTagsByCourseID(int $courseId) : array
        {
            $query = "SELECT t.* FROM tags t,course_tags ct WHERE t.tag_id=ct.tag_id AND ct.course_id = :course_id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":course_id",$courseId,\PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $tags = [];
            foreach($rows as $row){
                $tags[] = new Tag($row["tag_id"],$row["name"]);
            }
            return $tags;
        }
        
        //CRUD
        public function getAllCourses() : array
        {
            $query = "SELECT * FROM courseCategoryUser"; //view joining courses/categories/users tables
            $stmt = $this->con->query($query);
            $rows = $stmt->fetchAll();
            
            $courses = [];
            
            foreach($rows as $row){
                $courses[] = $this->mapRowToCourse($row);
            }
            
            return $courses;
        }
        
        public function getCourseById(int $id) : ?Course
        {
            $query = "SELECT * from courseCategoryUser WHERE course_id = :course_id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":course_id",$id,\PDO::PARAM_INT);
            $stmt->execute();
            if($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                return $this->mapRowToCourse($row);
            }else return NULL;
        }

        public function saveCourse(Course $course) : bool
        {
            $query = "INSERT INTO Courses(title, description, type, content, category_id, teacher_id) values (:title,:description,:type,:content,:category_id,:teacher_id);";
            $stmt = $this->con->prepare($query);

            $result = $stmt->execute([
                'title' => $course->title,
                'description' => $course->description, 
                'type' => $course->type, 
                'content' => $course->content, 
                'category_id' => $course->category->id, 
                'teacher_id' => $course->teacher->id
            ]);
            if($result)
            {
                $id = $this->con->lastInsertId();
                $this->saveTags($id,$course->tags); 
                return true;
            }
            return false;
        }
        
    }