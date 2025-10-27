-- قاعدة البيانات
CREATE DATABASE IF NOT EXISTS attendance_db;
USE attendance_db;

-- جدول المستخدمين
CREATE TABLE IF NOT EXISTS users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','employee') NOT NULL DEFAULT 'employee'
);

-- جدول الحضور
CREATE TABLE IF NOT EXISTS tblattendance (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  emp_name VARCHAR(100) NOT NULL,
  attendance_date DATE NOT NULL,
  attendance_time TIME NOT NULL,
  status ENUM('حاضر','متأخر','غائب') NOT NULL DEFAULT 'حاضر'
);

-- بيانات مبدئية
INSERT INTO users (username, password, role)
VALUES ('admin', 'admin123', 'admin'),
       ('employee', 'emp123', 'employee');
