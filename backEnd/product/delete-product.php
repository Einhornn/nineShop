<?php
require_once '../config-database.php';
session_start();

// Kiểm tra ID sản phẩm
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['product_error'] = "ID sản phẩm không hợp lệ.";
    header("Location: ../../admin.php?page=products");
    exit();
}

$product_id = (int)$_GET['id'];

// Kiểm tra sản phẩm tồn tại
$stmt = $conn->prepare("SELECT id FROM products_size_color WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $_SESSION['product_error'] = "Sản phẩm không tồn tại.";
    header("Location: ../../frontEnd/admin.php?page=products");
    exit();
}
$stmt->close();

// Xóa các bản ghi liên quan trong products_size_color
$stmt = $conn->prepare("DELETE FROM products_size_color WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->close();

$conn->close();
header("Location: ../../frontEnd/admin.php?page=products");
?>