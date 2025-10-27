<?php
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if (isset($_POST['mark'])) {
    date_default_timezone_set('Asia/Riyadh');
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $status = (strtotime($time) > strtotime('09:00:00')) ? 'متأخر' : 'حاضر';

    $query = "INSERT INTO tblattendance (emp_name, attendance_date, attendance_time, status)
              VALUES ('$username', '$date', '$time', '$status')";
    mysqli_query($conn, $query);

    echo "<script>alert('✅ تم تسجيل الحضور بنجاح');</script>";
}
?>

<h2>مرحبًا <?php echo $username; ?></h2>
<form method="POST">
    <button type="submit" name="mark">تسجيل الحضور</button>
</form>
<a href="logout.php">تسجيل الخروج</a>
