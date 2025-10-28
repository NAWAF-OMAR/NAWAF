<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}
include 'function.php';
$db = new DB_con();
$role = $_SESSION['role'];
$username = $_SESSION['username'];

// إضافة حضور
if(isset($_POST['add'])){
    $status = $_POST['status'];
    $db->addAttendance($username, $status);
}

// حذف حضور (Admin فقط)
if(isset($_GET['delete']) && $role=='admin'){
    $id = $_GET['delete'];
    $db->deleteAttendance($id);
}

// تعديل حضور (Admin فقط)
if(isset($_POST['update']) && $role=='admin'){
    $id = $_POST['id'];
    $status = $_POST['status'];
    $db->updateAttendance($id, $_POST['emp_name'], $status);
}

$attendances = $db->getAttendance();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
</head>
<body>
<h2>مرحباً <?php echo $username; ?> (<?php echo $role; ?>)</h2>

<!-- تسجيل حضور -->
<form method="post">
    <label>الحالة:</label>
    <select name="status">
        <option value="حاضر">حاضر</option>
        <option value="متأخر">متأخر</option>
        <option value="غائب">غائب</option>
    </select>
    <input type="submit" name="add" value="تسجيل حضور">
</form>

<hr>
<h3>سجل الحضور</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>الاسم</th>
        <th>التاريخ</th>
        <th>الوقت</th>
        <th>الحالة</th>
        <?php if($role=='admin') echo "<th>تعديل/حذف</th>"; ?>
    </tr>
    <?php while($row = $attendances->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $row['emp_name']; ?></td>
        <td><?php echo $row['attendance_date']; ?></td>
        <td><?php echo $row['attendance_time']; ?></td>
        <td>
            <?php 
                $status = $row['status'];
                if($status == 'حاضر') echo "<span style='color:green;font-weight:bold;'>$status</span>";
                elseif($status == 'متأخر') echo "<span style='color:orange;font-weight:bold;'>$status</span>";
                else echo "<span style='color:red;font-weight:bold;'>$status</span>";
            ?>
        </td>
        <?php if($role=='admin'){ ?>
        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="emp_name" value="<?php echo $row['emp_name']; ?>" required>
                <select name="status">
                    <option value="حاضر" <?php if($row['status']=='حاضر') echo 'selected'; ?>>حاضر</option>
                    <option value="متأخر" <?php if($row['status']=='متأخر') echo 'selected'; ?>>متأخر</option>
                    <option value="غائب" <?php if($row['status']=='غائب') echo 'selected'; ?>>غائب</option>
                </select>
                <input type="submit" name="update" value="تعديل">
            </form>
            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
        </td>
        <?php } ?>
    </tr>
    <?php } ?>
</table>

<br>
<a href="logout.php">تسجيل خروج</a>
</body>
</html>
