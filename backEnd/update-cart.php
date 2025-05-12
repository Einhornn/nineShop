<?php
session_start();
require_once 'config-database.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Vui lòng đăng nhập để thực hiện thao tác.';
    header('Location: ../frontEnd/login.php');
    exit;
}

$user_id = (int)$_SESSION['user_id'];

// Xử lý xóa sản phẩm
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['cart_id'])) {
    $cart_id = (int)$_GET['cart_id'];

    // Kiểm tra cart_id thuộc về user_id
    $stmt = $conn->prepare("SELECT id FROM cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $_SESSION['error'] = 'Không tìm thấy sản phẩm trong giỏ hàng.';
        $stmt->close();
        header('Location: ../frontEnd/cart.php');
        exit;
    }
    $stmt->close();

    // Xóa sản phẩm
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_id, $user_id);
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Xóa sản phẩm thành công!';
    } else {
        $_SESSION['error'] = 'Lỗi khi xóa sản phẩm.';
    }
    $stmt->close();
    header('Location: ../frontEnd/cart.php');
    exit;
}

// Xử lý cập nhật số lượng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart']) && isset($_POST['quantity'])) {
    $quantities = $_POST['quantity'];
    $success = true;
    $error_message = '';

    foreach ($quantities as $cart_id => $quantity) {
        $cart_id = (int)$cart_id;
        $quantity = (int)$quantity;

        if ($quantity < 1) {
            $error_message = 'Số lượng phải lớn hơn 0.';
            $success = false;
            break;
        }

        // Kiểm tra cart_id thuộc về user_id và lấy psc_id
        $stmt = $conn->prepare("
            SELECT c.product_id AS psc_id 
            FROM cart c 
            WHERE c.id = ? AND c.user_id = ?
        ");
        $stmt->bind_param("ii", $cart_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            $error_message = 'Không tìm thấy sản phẩm trong giỏ hàng.';
            $success = false;
            $stmt->close();
            break;
        }
        $cart_item = $result->fetch_assoc();
        $psc_id = $cart_item['psc_id'];
        $stmt->close();

        // Kiểm tra tồn kho
        $stmt = $conn->prepare("
            SELECT quantity 
            FROM products_size_color 
            WHERE id = ?
        ");
        $stmt->bind_param("i", $psc_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $psc = $result->fetch_assoc();
        $available_quantity = (int)$psc['quantity'];
        $stmt->close();

        if ($quantity > $available_quantity) {
            $error_message = 'Số lượng yêu cầu vượt quá tồn kho (' . $available_quantity . ') cho một sản phẩm.';
            $success = false;
            break;
        }

        // Cập nhật số lượng
        $stmt = $conn->prepare("
            UPDATE cart 
            SET quantity = ? 
            WHERE id = ? AND user_id = ?
        ");
        $stmt->bind_param("iii", $quantity, $cart_id, $user_id);
        if (!$stmt->execute()) {
            $error_message = 'Lỗi khi cập nhật số lượng.';
            $success = false;
            $stmt->close();
            break;
        }
        $stmt->close();
    }

    if ($success) {
        $_SESSION['success'] = 'Cập nhật giỏ hàng thành công!';
    } else {
        $_SESSION['error'] = $error_message;
    }
    header('Location: ../frontEnd/cart.php');
    exit;
}

// Nếu không có hành động hợp lệ
$_SESSION['error'] = 'Yêu cầu không hợp lệ.';
header('Location: ../frontEnd/cart.php');
exit;
?>