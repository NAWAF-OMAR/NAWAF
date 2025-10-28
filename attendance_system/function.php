<?php
class DB_con {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "attendance_db");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // تسجيل حضور
    public function addAttendance($emp_name, $status) {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO tblattendance (emp_name, attendance_date, attendance_time, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $emp_name, $date, $time, $status);
        return $stmt->execute();
    }

    // جلب الحضور
    public function getAttendance() {
        return $this->conn->query("SELECT * FROM tblattendance ORDER BY attendance_date DESC, attendance_time DESC");
    }

    // حذف حضور
    public function deleteAttendance($id) {
        return $this->conn->query("DELETE FROM tblattendance WHERE id='$id'");
    }

    // تعديل حضور
    public function updateAttendance($id, $emp_name, $status) {
        return $this->conn->query("UPDATE tblattendance SET emp_name='$emp_name', status='$status' WHERE id='$id'");
    }

    // تحقق تسجيل دخول
    public function login($username, $password) {
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);
        return $this->conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
    }
}
?>
