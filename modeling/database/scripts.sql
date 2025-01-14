create database Youdemy;

use Youdemy;

CREATE TABLE Users( 
	user_id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, 
    email VARCHAR(100) NOT NULL, role ENUM('student', 'teacher') NOT NULL, 
    status ENUM('active', 'suspended') DEFAULT 'active' 
);