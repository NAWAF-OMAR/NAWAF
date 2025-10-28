<?php
session_start();
include 'function.php';
$db = new DB_con();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $db->login($username, $password);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: attendance.php");
        exit;
    } else {
        $error = "اسم المستخدم أو كلمة المرور خاطئة";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>تسجيل الدخول</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    اسم المستخدم: <input type="text" name="username" required><br><br>
    كلمة المرور: <input type="password" name="password" required><br><br>
    <input type="submit" name="login" value="دخول">
</form>
</body>
</html>
