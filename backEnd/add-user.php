<?php
ob_start();
include 'config-database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $address = $_POST["address"] ?? '';

    if ($name && $email && $password && $phone && $address) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password_hash, phone, address, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi prepare SQL: " . $conn->error);
        }

        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $address);
        $stmt->execute();

        header("Location: ../frontEnd/admin.php?page=users");
        exit();
    } else {
        header("Location: ../frontEnd/admin.php?msg=empty");
        exit();
    }
}
?>
