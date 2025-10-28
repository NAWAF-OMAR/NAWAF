<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'attendance_system');

class DB_con {
    function __construct() {
        $this->dbh = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // دوال CRUD هنا (تسجيل مستخدم، تسجيل دخول، إضافة حضور، تعديل، حذف)
}
?>
