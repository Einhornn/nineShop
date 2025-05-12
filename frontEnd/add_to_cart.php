<?php
session_start();
include 'config-database.php';

if (!isset($_SESSION['user_id'])) {
    die("Bạn cần đăng nhập để thêm vào giỏ hàng.");
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'] ?? 1;

$check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");
if (mysqli_num_rows($check) > 0) {
    mysqli_query($conn, "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id");
} else {
    mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)");
}
header("Location: cart.php");
?>
