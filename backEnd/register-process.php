<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config-database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin!";
        header("Location: /clothingshop/frontEnd/login.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Mật khẩu không khớp!";
        header("Location: /clothingshop/frontEnd/login.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email không hợp lệ!";
        header("Location: /clothingshop/frontEnd/login.php");
        exit();
    }

    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $_SESSION['error'] = "Số điện thoại không hợp lệ!";
        header("Location: /clothingshop/frontEnd/login.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email đã được sử dụng!";
        header("Location: /clothingshop/frontEnd/login.php");
        exit();
    }
    $stmt->close();

    $password_hash = $password;

    $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash, phone, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $email, $password_hash, $phone);
    if ($stmt->execute()) {
        $user_id = $conn->insert_id;
        $stmt_role = $conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, 2)");
        $stmt_role->bind_param("i", $user_id);
        $stmt_role->execute();
        $stmt_role->close();

        $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
        header("Location: /clothingshop/frontEnd/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Đăng ký thất bại! Vui lòng thử lại.";
        header("Location: /clothingshop/frontEnd/login.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>