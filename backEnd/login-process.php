<?php
session_start();
include 'config-database.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Chuẩn bị truy vấn an toàn
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password); // s = string
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra có user không
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Lưu thông tin vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        // Điều hướng về trang chủ sau khi đăng nhập thành công
        header('Location: ../frontEnd/index.php');
        exit();
    } else {
        echo "<script>alert('Sai email hoặc mật khẩu!'); window.location.href='../frontEnd/login.php';</script>";
        exit();
    }
} else {
    // Không phải phương thức POST
    header("Location: ../frontEnd/login.php");
    exit();
}
?>
