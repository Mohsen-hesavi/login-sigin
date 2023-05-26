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

// کوئری دریافت جدول
$query = "SELECT COUNT(*) AS total_users FROM users";

// اجرای کوئری
$result = mysqli_query($conn, $query);

// بررسی موفقیت اجرای کوئری
if ($result) {
    // دریافت جدول به عنوان متغیر خروجی
    $table = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $table[] = $row;
    }

    // نمایش جدول
    print_r($number);
    $table = array(
    0 => array(
        'total_users' => 1
    )
);

$number = $table[0]['total_users'];
echo $number;
} else {
    echo "خطا در دریافت جدول: " . mysqli_error($conn);
}

// بستن اتصال به دیتابیس
mysqli_close($conn);
?>