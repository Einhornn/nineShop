<?php
include '../config-database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"] ?? null;
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $address = $_POST["address"] ?? '';

    if ($id && $name && $email && $phone && $address) {
        $sql = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);
        $stmt->execute();
        header("Location: ../../frontEnd/admin.php?page=users&msg=updated");
        exit();
    } else {
        header("Location: ../../frontEnd/admin.php?page=users&msg=empty");
        exit();
    }
}
