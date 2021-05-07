CREATE DATABASE planner COLLATE latin1_general_cs;
USE planner;

CREATE TABLE majors (
    id INT(50) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    isMinor BIT,
    isOnlyMinor BIT
);

CREATE TABLE users (
    id INT(50) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50),
    emplid INT(8),
    majorID INT(50),
    minorID INT(50),
    FOREIGN KEY(majorID) REFERENCES majors(id)
);

CREATE TABLE courses (
    id INT(50) AUTO_INCREMENT PRIMARY KEY,
    majorID INT(50),
    courseCode VARCHAR(50),
    courseName VARCHAR(50),
    courseDesc LONGTEXT,
    credits INT(5),
    coursePrereq LONGTEXT,
    isElective INT(1),
    FOREIGN KEY(majorID) REFERENCES majors(id)
);

CREATE TABLE courses_taken (
    id INT(50) AUTO_INCREMENT PRIMARY KEY,
    userID INT(50),
    courseID INT(50),
    groupID INT(50),
    FOREIGN KEY(userID) REFERENCES users(id),
    FOREIGN KEY(courseID) REFERENCES courses(id)
);


INSERT INTO majors(name, isMinor, isOnlyMinor) VALUES ("Computer Science", 1, 0), ("Accounting", 1, 0), ("Mathematics", 1, 0)
