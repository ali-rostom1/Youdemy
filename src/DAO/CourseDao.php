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
        public static $perPage = 2;

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
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($row){
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
        public function saveTags(int $courseId,array $tags) : void
        {
            $stmt = $this->con->prepare("DELETE FROM course_tags WHERE course_id = :course_id");
            $stmt->execute(['course_id' => $courseId]);
            
            $query = "INSERT INTO course_tags(course_id,tag_id) values (:course_id,:tag_id)";
            $stmt = $this->con->prepare($query);
            foreach($tags as $tag){
                $stmt->execute([
                    "course_id" => $courseId,
                    "tag_id" =>  $tag->id
                    ]);
            }
        }
        public function updateCourse(Course $course): bool 
        { 
            $query = "UPDATE Courses SET title = :title, description = :description, type = :type, content = :content, category_id = :category_id, teacher_id = :teacher_id WHERE course_id = :id";
            $stmt = $this->con->prepare($query); 
            $result = $stmt->execute([ 
                'id' => $course->id, 
                'title' => $course->title, 
                'description' => $course->description, 
                'type' => $course->type, 
                'content' => $course->content, 
                'category_id' => $course->category->id, 
                'teacher_id' => $course->teacher->id
            ]); 
            if ($result) { 
                $this->saveTags($course->id,$course->tags); 
                return true; 
            } 
            return false; 
        }
        public function deleteCourse(int $id): bool 
        { 
            $stmt = $this->con->prepare("DELETE FROM Courses WHERE course_id = :id"); 
            return $stmt->execute(['id' => $id]); 
        }
        //other needed function
        public function getAllVideoCourses() : array
        {
            $query = "SELECT * FROM courseCategoryUser where type= 'Video' ";
            $stmt = $this->con->query($query);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $courses = [];

            foreach($rows as $row){
                $courses[] = $this->mapRowToCourse($row);
            }
            return $courses;
        }
        public function getVideoCoursesCount() : int
        {
            $query = "SELECT count(*) as TOTAL FROM courses where type ='Video'";
            $stmt = $this->con->query($query);
            $count = $stmt->fetch(\PDO::FETCH_ASSOC);
            return isset($count["TOTAL"]) ? $count["TOTAL"] : NULL;
        }
        public function getDocumentCoursesCount() : int
        {
            $query = "SELECT count(*) as TOTAL FROM courses where type ='Document'";
            $stmt = $this->con->query($query);
            $count = $stmt->fetch(\PDO::FETCH_ASSOC);
            return isset($count["TOTAL"]) ? $count["TOTAL"] : NULL;
        }
        public function getCoursesLimit($page) : ?array
        {
            $offset = ($page-1) * self::$perPage;
            $perPage = self::$perPage;
            $query = "SELECT * FROM courseCategoryUser LIMIT :offset,$perPage";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":offset",$offset,\PDO::PARAM_INT);
            var_dump($stmt);

            if($stmt->execute()){
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $courses = [];
                if($rows){
                    foreach($rows as $row){
                        $courses[] = $this->mapRowToCourse($row);
                    }
                    return $courses;
                }
                return NULL;
                
            }else return false;   
        }
    }