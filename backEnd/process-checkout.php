<?php
session_start();
require_once 'config-database.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Vui lòng đăng nhập để thanh toán.';
    header('Location: ../frontEnd/login.php');
    exit;
}

$user_id = (int)$_SESSION['user_id'];

// Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = 'Yêu cầu không hợp lệ.';
    header('Location: ../frontEnd/checkout.php');
    exit;
}

// Lấy thông tin giao hàng
$full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';

if (empty($full_name) || empty($phone) || empty($address)) {
    $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin giao hàng.';
    header('Location: ../frontEnd/checkout.php');
    exit;
}

// Kiểm tra định dạng số điện thoại (10 chữ số)
if (!preg_match('/^[0-9]{10}$/', $phone)) {
    $_SESSION['error'] = 'Số điện thoại không hợp lệ. Vui lòng nhập 10 chữ số.';
    header('Location: ../frontEnd/checkout.php');
    exit;
}

// Lấy giỏ hàng
$query = "
    SELECT c.id, c.product_id AS psc_id, c.quantity, p.price
    FROM cart c
    JOIN products_size_color psc ON c.product_id = psc.id
    JOIN products p ON psc.id_product = p.id
    WHERE c.user_id = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = [];
$subtotal = 0;
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $subtotal += $row['price'] * $row['quantity'];
}
$stmt->close();

if (empty($cart_items)) {
    $_SESSION['error'] = 'Giỏ hàng của bạn đang trống.';
    header('Location: ../frontEnd/cart.php');
    exit;
}

$total = $subtotal; // Tổng tiền từ giỏ hàng, đã bao gồm phí vận chuyển

// Bắt đầu transaction
$conn->begin_transaction();

try {
    // Tạo bản ghi thanh toán
    $stmt = $conn->prepare("
        INSERT INTO payments (payment_method, payment_status)
        VALUES ('cod', 'pending')
    ");
    if (!$stmt->execute()) {
        throw new Exception('Lỗi khi tạo bản ghi thanh toán.');
    }
    $payment_id = $conn->insert_id;
    $stmt->close();

    // Tạo đơn hàng
    $stmt = $conn->prepare("
        INSERT INTO orders (user_id, payments_id, total_amount, status)
        VALUES (?, ?, ?, 'pending')
    ");
    $stmt->bind_param("iid", $user_id, $payment_id, $total);
    if (!$stmt->execute()) {
        throw new Exception('Lỗi khi tạo đơn hàng.');
    }
    $order_id = $conn->insert_id;
    $stmt->close();

    // Thêm chi tiết đơn hàng và cập nhật tồn kho
    foreach ($cart_items as $item) {
        $psc_id = $item['psc_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        // Kiểm tra tồn kho
        $stmt = $conn->prepare("SELECT quantity FROM products_size_color WHERE id = ? FOR UPDATE");
        $stmt->bind_param("i", $psc_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $psc = $result->fetch_assoc();
        $available_quantity = (int)$psc['quantity'];
        $stmt->close();

        if ($quantity > $available_quantity) {
            throw new Exception('Số lượng yêu cầu vượt quá tồn kho (' . $available_quantity . ') cho một sản phẩm.');
        }

        // Thêm chi tiết đơn hàng
        $stmt = $conn->prepare("
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("iiid", $order_id, $psc_id, $quantity, $price);
        if (!$stmt->execute()) {
            throw new Exception('Lỗi khi thêm chi tiết đơn hàng.');
        }
        $stmt->close();

        // Cập nhật tồn kho
        $stmt = $conn->prepare("
            UPDATE products_size_color 
            SET quantity = quantity - ? 
            WHERE id = ?
        ");
        $stmt->bind_param("ii", $quantity, $psc_id);
        if (!$stmt->execute()) {
            throw new Exception('Lỗi khi cập nhật tồn kho.');
        }
        $stmt->close();
    }

    // Xóa giỏ hàng
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
        throw new Exception('Lỗi khi xóa giỏ hàng.');
    }
    $stmt->close();

    // Commit transaction
    $conn->commit();

    $_SESSION['success'] = 'Đặt hàng thành công! Mã đơn hàng: ' . $order_id;
    header('Location: ../frontEnd/order-confirmation.php');
    exit;
} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    error_log("Checkout failed: user_id=$user_id, error=" . $e->getMessage());
    header('Location: ../frontEnd/checkout.php');
    exit;
}

$conn->close();
?>