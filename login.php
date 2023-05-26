 <!--        _______                        _     -->
 <!--   ____|__   __|                      | |    -->
 <!--  / __ \  | |  __ _  _ __  ___  _   _ | |__  -->
 <!-- / / _` | | | / _` || '__|/ __|| | | || '_ \ -->
 <!--| | (_| | | || (_| || |  | (__ | |_| || |_) |-->
 <!-- \ \__,_| |_| \__,_||_|   \___| \__, ||_.__/ -->
 <!--  \____/                         __/ |       -->
 <!--                                |___/        -->
<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت اطلاعات فرم ورود
    $username = $_POST["email"];
    $password = $_POST["pass"];
    // بررسی وجود خطا در اتصال
    if ($conn->connect_error) {
        die("خطا در اتصال به دیتابیس: " . $conn->connect_error);
    }

    // استعلام برای بررسی اعتبار لاگین
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // اعتبارسنجی موفقیت‌آمیز - اجازه ورود به کاربر
        $_SESSION["username"] = $username;
        $stmt->close();
        $conn->close();
        header("Location: dashboard.php"); // فرستادن کاربر به صفحه داشبورد یا صفحه دیگر
        exit();
    } else {
        // اعتبارسنجی ناموفق - نمایش پیام خطا
        echo("اطلاعات وارد شده اشتباه است");

    }

    // بستن اتصال به دیتابیس
    $stmt->close();
    $conn->close();
}
?>