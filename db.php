<?php
$host = "localhost";
$user = "root";
$pass = ""; // أو ضع كلمة مرورك إن وجدت
$db   = "attendance_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>
