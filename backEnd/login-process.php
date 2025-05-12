<?php
ob_start(); // Bật output buffering
session_start();
require_once 'config-database.php'; // Include kết nối database

// Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = 'Yêu cầu không hợp lệ.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Lấy dữ liệu từ form
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Kiểm tra các trường bắt buộc
if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'Vui lòng điền đầy đủ email và mật khẩu.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Kiểm tra định dạng email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Email không hợp lệ.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Tìm người dùng trong cơ sở dữ liệu
$stmt = $conn->prepare("SELECT id, name, password_hash FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Email hoặc mật khẩu không đúng.';
    $stmt->close();
    header('Location: ../frontEnd/login.php');
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

// Kiểm tra mật khẩu
if (!password_verify($password, $user['password_hash'])) {
    $_SESSION['error'] = 'Email hoặc mật khẩu không đúng.';
    header('Location: ../frontEnd/login.php');
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];

$stmt = $conn->prepare("SELECT role FROM user_roles WHERE user_id = ?");
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$result = $stmt->get_result();
$roleRow = $result->fetch_assoc();
$_SESSION['user_role'] = $roleRow['role'] ?? 'khachhang';

$_SESSION['success'] = 'Đăng nhập thành công!';
header('Location: ../frontEnd/index.php');
exit;

$conn->close();
ob_end_flush(); 
?>