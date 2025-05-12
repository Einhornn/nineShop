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
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

// Kiểm tra các trường bắt buộc
if (empty($name) || empty($phone) || empty($email) || empty($address) || empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Kiểm tra định dạng email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Email không hợp lệ.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Kiểm tra định dạng số điện thoại (10-15 chữ số)
if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
    $_SESSION['error'] = 'Số điện thoại không hợp lệ. Vui lòng nhập 10-15 chữ số.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Kiểm tra độ dài mật khẩu (tối thiểu 6 ký tự)
if (strlen($password) < 6) {
    $_SESSION['error'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Kiểm tra mật khẩu khớp
if ($password !== $confirm_password) {
    $_SESSION['error'] = 'Mật khẩu không khớp.';
    header('Location: ../frontEnd/login.php');
    exit;
}

// Kiểm tra email đã tồn tại
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    $_SESSION['error'] = 'Email đã được sử dụng.';
    $stmt->close();
    header('Location: ../frontEnd/login.php');
    exit;
}
$stmt->close();

// Mã hóa mật khẩu
$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    // Chèn người dùng vào bảng users
    $stmt = $conn->prepare("
        INSERT INTO users (name, email, password_hash, phone, address)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("sssss", $name, $email, $password_hash, $phone, $address);
    if (!$stmt->execute()) {
        throw new Exception('Lỗi khi tạo tài khoản.');
    }
    $stmt->close();

    // Đặt thông báo thành công
    $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
    header('Location: ../frontEnd/login.php');
    exit;
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    error_log("Registration failed: email=$email, error=" . $e->getMessage());
    header('Location: ../frontEnd/login.php');
    exit;
}

$conn->close();
ob_end_flush(); // Xả buffer
?>