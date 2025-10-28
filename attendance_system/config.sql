-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS attendance_system;

USE attendance_system;

-- جدول المستخدمين
CREATE TABLE IF NOT EXISTS tblusers (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  FullName VARCHAR(100) NOT NULL,
  Username VARCHAR(50) NOT NULL UNIQUE,
  UserEmail VARCHAR(100) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

-- مثال لإدخال مستخدم admin
INSERT INTO tblusers (FullName, Username, UserEmail, Password, role)
VALUES ('Admin User', 'admin', 'admin@example.com', 'admin123', 'admin');

-- جدول الحضور
CREATE TABLE IF NOT EXISTS attendance (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL,
  name VARCHAR(100) NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  FOREIGN KEY (user_id) REFERENCES tblusers(id)
);
