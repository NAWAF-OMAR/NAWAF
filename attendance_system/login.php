<?php
session_start();
include_once('function.php');
$u = new DB_con();

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $res = $u->login($username, $password);
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role']; // admin or employee
        header("Location: attendance.php");
        exit();
    } else {
        $error = "Invalid Username or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" name="login" value="Login">
</form>
</body>
</html>
