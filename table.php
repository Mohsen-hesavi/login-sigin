 <!--        _______                        _     -->
 <!--   ____|__   __|                      | |    -->
 <!--  / __ \  | |  __ _  _ __  ___  _   _ | |__  -->
 <!-- / / _` | | | / _` || '__|/ __|| | | || '_ \ -->
 <!--| | (_| | | || (_| || |  | (__ | |_| || |_) |-->
 <!-- \ \__,_| |_| \__,_||_|   \___| \__, ||_.__/ -->
 <!--  \____/                         __/ |       -->
 <!--                                |___/  -->
<?php
$servername = "localhost"; // نام سرور دیتابیس
$db_username = "mohsen2_log"; // نام کاربری دیتابیس
$db_password = "kng.~t-5ab0("; // رمز عبور دیتابیس
$dbname = "mohsen2_log"; // نام دیتابیس

// اتصال به دیتابیس
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// بررسی وجود خطا در اتصال
if ($conn->connect_error) {
    die("خطا در اتصال به دیتابیس: " . $conn->connect_error);
}

// کوئری ساخت جدول
$query = "
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user VARCHAR(50) NOT NULL
)";

// اجرای کوئری
if ($conn->query($query) === TRUE) {
    echo "جدول با موفقیت ایجاد شد.";
} else {
    echo "خطا در ایجاد جدول: " . $conn->error;
}

// بستن اتصال به دیتابیس
$conn->close();
?>
