<?php
session_start();
require_once 'config-database.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = (int)$_SESSION['user_id'];
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $color_id = isset($_POST['color_id']) ? (int)$_POST['color_id'] : 0;
    $size_id = isset($_POST['size_id']) ? (int)$_POST['size_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    if ($product_id <= 0 || $color_id <= 0 || $size_id <= 0 || $quantity <= 0) {
        $response['message'] = 'Thông tin không hợp lệ.';
        echo json_encode($response);
        exit;
    }

    // Kiểm tra products_size_color id
    $stmt = $conn->prepare("
        SELECT id, quantity 
        FROM products_size_color 
        WHERE id_product = ? AND id_color = ? AND id_size = ?
    ");
    $stmt->bind_param("iii", $product_id, $color_id, $size_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $psc = $result->fetch_assoc();
    $stmt->close();

    if (!$psc) {
        $response['message'] = 'Sản phẩm với màu và kích cỡ này không tồn tại.';
        echo json_encode($response);
        exit;
    }

    $psc_id = $psc['id'];
    $available_quantity = (int)$psc['quantity'];

    if ($quantity > $available_quantity) {
        $response['message'] = 'Số lượng yêu cầu vượt quá tồn kho (' . $available_quantity . ').';
        echo json_encode($response);
        exit;
    }

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $stmt = $conn->prepare("
        SELECT id, quantity 
        FROM cart 
        WHERE user_id = ? AND product_id = ?
    ");
    $stmt->bind_param("ii", $user_id, $psc_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing_item = $result->fetch_assoc();
    $stmt->close();

    if ($existing_item) {
        // Cập nhật số lượng
        $new_quantity = $existing_item['quantity'] + $quantity;
        if ($new_quantity > $available_quantity) {
            $response['message'] = 'Tổng số lượng trong giỏ hàng vượt quá tồn kho (' . $available_quantity . ').';
            echo json_encode($response);
            exit;
        }

        $stmt = $conn->prepare("
            UPDATE cart 
            SET quantity = ? 
            WHERE id = ?
        ");
        $stmt->bind_param("ii", $new_quantity, $existing_item['id']);
        $success = $stmt->execute();
        $stmt->close();
    } else {
        // Thêm mới vào giỏ hàng
        $stmt = $conn->prepare("
            INSERT INTO cart (user_id, product_id, quantity) 
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("iii", $user_id, $psc_id, $quantity);
        $success = $stmt->execute();
        $stmt->close();
    }

    if ($success) {
        $response['success'] = true;
        $response['message'] = 'Thêm vào giỏ hàng thành công!';
    } else {
        $response['message'] = 'Lỗi khi thêm vào giỏ hàng.';
    }
} else {
    $response['message'] = 'Vui lòng đăng nhập để thêm vào giỏ hàng.';
}

echo json_encode($response);
$conn->close();
?>