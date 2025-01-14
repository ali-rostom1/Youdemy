create database Youdemy;

use Youdemy;

CREATE TABLE Users( 
	user_id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL, 
    password VARCHAR(255) NOT NULL, 
    email VARCHAR(100) NOT NULL, 
    role ENUM('student', 'teacher') NOT NULL, 
    status ENUM('active', 'suspended') DEFAULT 'active' 
);


CREATE TABLE Categories ( 
	category_id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(50) NOT NULL, 
    description VARCHAR(255) 
);


CREATE TABLE Courses ( 
	course_id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(100) NOT NULL, description TEXT, 
    content VARCHAR(255), 
    category_id INT, 
    teacher_id INT, 
    FOREIGN KEY (teacher_id) REFERENCES Users(user_id),
    Foreign Key (category_id) REFERENCES Categories(category_id)
);

CREATE TABLE Tags ( 
	tag_id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(50) NOT NULL 
);

CREATE TABLE Course_Tags ( 
	course_id INT, tag_id INT,
    PRIMARY KEY (course_id, tag_id), 
    FOREIGN KEY (course_id) REFERENCES Courses(course_id), 
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id) 
);

CREATE TABLE Enrollment ( 
	enrollment_id INT AUTO_INCREMENT PRIMARY KEY, 
    user_id INT, course_id INT, 
    enrollment_date DATE, 
    FOREIGN KEY (user_id) REFERENCES Users(user_id), 
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) 
);
ALTER TABLE Users MODIFY COLUMN role ENUM('student', 'teacher', 'admin') NOT NULL;