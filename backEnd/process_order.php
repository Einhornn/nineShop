<?php
session_start();
include 'config-database.php';

$user_id = $_SESSION['user_id'];
$address = mysqli_real_escape_string($conn, $_POST['address']);
$payment_method = $_POST['payment_method']; 

$payments_id = $payment_method === 'cod' ? 1 : 2;

$cart_items = mysqli_query($conn, "SELECT * FROM cart JOIN products ON cart.product_id = products.id WHERE user_id = $user_id");

if (mysqli_num_rows($cart_items) == 0) {
    echo "Giỏ hàng trống.";
    exit;
}

$total = 0;
while ($row = mysqli_fetch_assoc($cart_items)) {
    $total += $row['quantity'] * $row['price'];
}

mysqli_query($conn, "INSERT INTO orders (user_id, payments_id, total_amount, status, created_at) 
                     VALUES ($user_id, $payments_id, $total, 'pending', NOW())");

$order_id = mysqli_insert_id($conn);
mysqli_data_seek($cart_items, 0);
while ($row = mysqli_fetch_assoc($cart_items)) {
    $pid = $row['product_id'];
    $qty = $row['quantity'];
    $price = $row['price'];
    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) 
                         VALUES ($order_id, $pid, $qty, $price)");
}
mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

echo "<div class='container mt-4 alert alert-success'>Đơn hàng đã được tạo thành công! Mã đơn là #$order_id</div>";
?>
