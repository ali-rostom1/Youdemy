create database Youdemy;

use Youdemy;

CREATE TABLE Users( 
	user_id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL, 
    password VARCHAR(255) NOT NULL, 
    email VARCHAR(100) NOT NULL, 
    role ENUM('student', 'teacher','admin') NOT NULL, 
    status ENUM('active', 'suspended',"pending") DEFAULT 'active' 
);


CREATE TABLE Categories ( 
	category_id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(50) NOT NULL, 
    description VARCHAR(255) 
);
CREATE TABLE Courses ( 
	course_id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(100) NOT NULL, description TEXT, 
    type enum("document","video"),
    content TEXT, 
    category_id INT, 
    teacher_id INT, 
    FOREIGN KEY (teacher_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    Foreign Key (category_id) REFERENCES Categories(category_id) ON DELETE CASCADE
);
CREATE TABLE Tags ( 
	tag_id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(50) NOT NULL 
);
CREATE TABLE Course_Tags ( 
	course_id INT, tag_id INT,
    PRIMARY KEY (course_id, tag_id), 
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE, 
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id) ON DELETE CASCADE
);
CREATE TABLE Enrollment ( 
	enrollment_id INT AUTO_INCREMENT PRIMARY KEY, 
    user_id INT, course_id INT, 
    enrollment_date DATE, 
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE, 
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);

INSERT INTO Categories (name, description) VALUES 
('Mathematics', 'Courses related to mathematics and its applications.'), 
('Science', 'Courses covering various scientific disciplines.'), 
('Arts', 'Courses focused on arts, including music, painting, and more.'), 
('Technology', 'Courses on technology, programming, and related fields.');
INSERT INTO Tags (name) VALUES 
('Beginner'), ('Intermediate'), 
('Advanced'), ('Professional'), 
('Programming'), ('Design');


INSERT INTO Courses (title, description, type, content, category_id, teacher_id) VALUES 
('Introduction to Algebra', 'A beginner course on algebra.', 'document', 'This course covers the basics of algebra including variables, equations, and functions.', 1, 2),
 ('Physics 101', 'An introductory course on physics.', 'video', 'http://example.com/physics101.mp4', 2, 3), 
 ('Painting for Beginners', 'Learn the basics of painting.', 'video', 'http://example.com/painting.mp4', 3, 4), 
 ('Advanced Python Programming', 'Master advanced concepts in Python.', 'document', 'Deep dive into advanced Python topics such as decorators, generators, and asynchronous programming.', 4, 2);

insert into users(username,password,email,role) values
("Ali Rostom","$2y$10$sNi5RSrO2XDAAMqXkhh4TeGvIAxXIrnhMbQBuij/baUeKbNwoqWpS","ali.rostom@gmail.com","teacher"),
("Ali Rostom123","$2y$10$sNi5RSrO2XDAAMqXkhh4TeGvIAxXIrnhMbQBuij/baUeKbNwoqWpS","ali.rostom123@gmail.com","teacher"),
("Ali Rostom1234","$2y$10$sNi5RSrO2XDAAMqXkhh4TeGvIAxXIrnhMbQBuij/baUeKbNwoqWpS","ali.rostom1234@gmail.com","teacher"),
("Ali Rostom12345","$2y$10$sNi5RSrO2XDAAMqXkhh4TeGvIAxXIrnhMbQBuij/baUeKbNwoqWpS","ali.rostom12345@gmail.com","teacher"),
("Ali Rostom123456","$2y$10$sNi5RSrO2XDAAMqXkhh4TeGvIAxXIrnhMbQBuij/baUeKbNwoqWpS","ali.rostom123456@gmail.com","admin"),
("Ali Rostom1234567","$2y$10$sNi5RSrO2XDAAMqXkhh4TeGvIAxXIrnhMbQBuij/baUeKbNwoqWpS","ali.rostom1234567@gmail.com","student");

INSERT INTO Course_Tags (course_id, tag_id) VALUES (5, 1), (5, 5), (6, 1), (6, 6), (7, 1), (8, 3), (8, 5);

create view courseCategoryUser AS 
SELECT 
	c.*,
    ct.name AS category_name,
    ct.description AS category_description,
    u.username AS teacher_name, 
    u.email AS teacher_email,
    u.status AS status
FROM Courses c 
JOIN Categories ct ON c.category_id = ct.category_id 
JOIN Users u ON c.teacher_id = u.user_id;

CREATE VIEW courseCategoryUserEnrollment AS 
SELECT 
    c.*, 
    ct.name AS category_name,
    ct.description AS category_description,
    u.username AS teacher_name, 
    u.email AS teacher_email,
    u.status AS status,
    e.enrollment_id,
    e.enrollment_date,
    eu.username AS student_username,
    eu.email AS student_email,
    eu.role AS student_role,
    eu.status AS student_status
FROM Courses c 
JOIN Categories ct ON c.category_id = ct.category_id 
JOIN Users u ON c.teacher_id = u.user_id
JOIN Enrollment e ON c.course_id = e.course_id
JOIN Users eu ON e.user_id = eu.user_id;

alter table enrollment modify column enrollment_date timestamp default current_timestamp;
ALTER TABLE Enrollment ADD CONSTRAINT unique_user_course UNIQUE (user_id, course_id);

INSERT INTO Enrollment (user_id, course_id, enrollment_date) VALUES 
(1, 5),
(2, 5),
(1, 6),
(3, 6),
(4, 6),
(2, 7),
(3, 8);

select * from categoryCount;
CREATE VIEW categoryCount AS
SELECT 
    ct.category_id,
    ct.name ,
    ct.description,
    COUNT(c.course_id) AS course_count
FROM Categories ct
LEFT JOIN Courses c ON ct.category_id = c.category_id
GROUP BY ct.category_id, ct.name, ct.description;