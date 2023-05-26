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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت اطلاعات فرم ثبت نام
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = $_POST["user"];

    // بررسی وجود خطا در اتصال
    if ($conn->connect_error) {
        die("خطا در اتصال به دیتابیس: " . $conn->connect_error);
    }

    // بررسی تکراری نبودن نام کاربری با استعلام آماده شده
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // نام کاربری تکراری است - نمایش پیام خطا
        echo ("نام کاربری قبلاً استفاده شده است");
    } else {
        // ثبت نام کاربر جدید با استعلام آماده شده
        $query = "INSERT INTO users (username, password, user) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $username, $password, $user);
        if ($stmt->execute()) {
            // ثبت نام موفقیت‌آمیز - اعلان موفقیت به کاربر
            echo("ثبت نام با موفقیت انجام شد.");
        } else {
            // خطا در ثبت نام - نمایش پیام خطا
             echo("خطا در ثبت نام.");
        }
    }

    // بستن استعلام‌ها و اتصال به دیتابیس
    $stmt->close();
    $conn->close();
}
?>