<?php
session_start();
include("db.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'admin') {
            header("Location: index.php");
        } else {
            header("Location: attendance.php");
        }
        exit();
    } else {
        echo "<script>alert('❌ اسم المستخدم أو كلمة المرور غير صحيحة');</script>";
    }
}
?>

<h2>تسجيل الدخول</h2>
<form method="POST">
    <input type="text" name="username" placeholder="اسم المستخدم" required><br>
    <input type="password" name="password" placeholder="كلمة المرور" required><br>
    <button type="submit" name="login">دخول</button>
</form>
