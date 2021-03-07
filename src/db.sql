CREATE DATABASE planner COLLATE latin1_general_cs;
USE planner;

CREATE TABLE users (
    userID int(50) AUTO_INCREMENT PRIMARY KEY,
    username varchar(50),
    email varchar(50),
    password varchar(50),
    emplid int(8)
);