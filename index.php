<?php
session_start();
include("db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: attendance.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM tblattendance ORDER BY attendance_date DESC");
?>

<h2>سجل الحضور</h2>
<table border="1">
<tr>
    <th>الاسم</th>
    <th>التاريخ</th>
    <th>الوقت</th>
    <th>الحالة</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['emp_name']; ?></td>
    <td><?= $row['attendance_date']; ?></td>
    <td><?= $row['attendance_time']; ?></td>
    <td><?= $row['status']; ?></td>
</tr>
<?php } ?>
</table>

<a href="logout.php">تسجيل الخروج</a>
