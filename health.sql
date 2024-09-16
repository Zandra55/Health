SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";






CREATE TABLE `student` (
    `student_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(50) NOT NULL,
    `date_of_birth` date NOT NULL,
    `gender` varchar(10) NOT NULL,
    `address` varchar(200) NOT NULL,
    `weight` varchar(30) NOT NULL,
    `height` varchar(30) NOT NULL,
    `illness` varchar(200) NOT NULL,
   
    `past_medical_history` varchar(200) NOT NULL,
  
    `mental_health` varchar(200) NOT NULL,

    `medication` varchar(200) NOT NULL,
    `guardian_fname` varchar(200) NOT NULL,
    `guardian_contact` varchar(200) NOT NULL,
    `department` varchar(50) NOT NULL,
    PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `teacher` (
    `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(50) NOT NULL,
    `address` varchar(50) NOT NULL,
    `date_of_birth` date NOT NULL,
    `gender` varchar(10) NOT NULL,
    `weight` varchar(50) NOT NULL,
    `height` varchar(50) NOT NULL,
    `illness` varchar(200) NOT NULL,
    
    `past_medical_history` varchar(200) NOT NULL,

    `mental_health` varchar(200) NOT NULL,

    `medication` varchar(200) NOT NULL,
    `guardian_fname` varchar(100) NOT NULL,
    `guardian_contact` varchar(50) NOT NULL,
    `salary` double NOT NULL,
    `department` varchar(50) NOT NULL,
    PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `teacher_messages` (
    `message_id` INT AUTO_INCREMENT PRIMARY KEY,
    `sender_id` INT NOT NULL,
    `recipient_id` INT NOT NULL,
    `message` TEXT NOT NULL,
    `file_name` VARCHAR(255),
    `file_size` INT,
    `file_type` VARCHAR(50),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`sender_id`) REFERENCES `teacher`(`teacher_id`),
    FOREIGN KEY (`recipient_id`) REFERENCES `student`(`student_id`)
);

CREATE TABLE `student_messages` (
    `message_id` INT AUTO_INCREMENT PRIMARY KEY,
    `sender_id` INT NOT NULL,
    `recipient_type` ENUM('student', 'teacher') NOT NULL DEFAULT 'teacher',
    `message` TEXT NOT NULL,
    `file_name` VARCHAR(255),
    `file_size` INT,
    `file_type` VARCHAR(50),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`sender_id`) REFERENCES `student`(`student_id`)
);
CREATE TABLE `prescription_history` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_id INT NOT NULL,
    recipient_type ENUM('student', 'teacher') NOT NULL,
    doctor_name VARCHAR(255) NOT NULL,
    medications TEXT NOT NULL,
    instructions TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE `notices` (
    notice_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    teacher_id INT,
    recipient_type ENUM('student', 'teacher') NOT NULL DEFAULT 'student',
    notice_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    file_name VARCHAR(255)
);





COMMIT;
ALTER TABLE `notices`
ADD COLUMN `sender_type` ENUM('student', 'teacher') NOT NULL DEFAULT 'teacher' AFTER `recipient_type`;

ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1; 
ALTER TABLE teacher_messages
DROP FOREIGN KEY teacher_messages_ibfk_2;


ALTER TABLE teacher_messages
ADD COLUMN recipient_type ENUM('admin', 'student') NOT NULL DEFAULT 'admin' AFTER sender_id;