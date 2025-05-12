<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];

if (!empty($_POST['product_id']) && !empty($_POST['quantity'])) {
    foreach ($_POST['product_id'] as $index => $product_id) {
        $qty = (int) $_POST['quantity'][$index];
        $product_id = (int) $product_id;

        if ($qty > 0) {
            mysqli_query($conn, "UPDATE cart SET quantity = $qty WHERE user_id = $user_id AND product_id = $product_id");
        }
    }

    header("Location: cart.php");
    exit;
} else {
    echo "Dữ liệu gửi lên không hợp lệ.";
}
?>
