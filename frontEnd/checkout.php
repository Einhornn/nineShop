<?php
ob_start(); // Bật output buffering
session_start();

// Kiểm tra đăng nhập trước khi xuất bất kỳ output nào
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Vui lòng đăng nhập để thanh toán.';
    header('Location: login.php');
    exit;
}

$user_id = (int)$_SESSION['user_id'];
require_once '../backEnd/config-database.php'; // Include config sau khi kiểm tra
?>

<!doctype html>
<html class="no-js" lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Thanh toán</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
    </style>
</head>

<body>
    <?php
    include "includes/header.php";

    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Vui lòng đăng nhập để thanh toán.';
        header('Location: login.php');
        exit;
    }

    $user_id = (int)$_SESSION['user_id'];
    $subtotal = 0;

    // Lấy thông tin người dùng
    $stmt = $conn->prepare("SELECT name, phone, address FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Lấy giỏ hàng
    $query = "
        SELECT c.id, c.product_id AS psc_id, c.quantity, p.id AS product_id, p.name, p.price, p.image_url_1, co.name AS color_name, s.size
        FROM cart c
        JOIN products_size_color psc ON c.product_id = psc.id
        JOIN products p ON psc.id_product = p.id
        JOIN color co ON psc.id_color = co.id
        JOIN size s ON psc.id_size = s.id
        WHERE c.user_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart_items = [];
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $subtotal += $row['price'] * $row['quantity'];
    }
    $stmt->close();

    if (empty($cart_items)) {
        $_SESSION['error'] = 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.';
        header('Location: cart.php');
        exit;
    }

    $total = $subtotal; // Tổng tiền lấy từ giỏ hàng, đã bao gồm phí vận chuyển
    ?>

    <div class="breadcrumbs_area other_bread">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.php">trang chủ</a></li>
                            <li>/</li>
                            <li><a href="cart.php">giỏ hàng</a></li>
                            <li>/</li>
                            <li>thanh toán</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>

    <div class="checkout_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="billing_info">
                        <h3>Thông tin giao hàng</h3>
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>
                        <form action="../backEnd/process-checkout.php" method="POST" id="checkout-form">
                            <div class="form-group">
                                <label for="full_name">Họ và tên *</label>
                                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại *</label>
                                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ giao hàng *</label>
                                <textarea id="address" name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>
                            </div>
                            <button type="submit" class="button">Đặt hàng</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="order_info">
                        <h3>Đơn hàng của bạn</h3>
                        <div class="order_table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_items as $item): ?>
                                        <tr>
                                            <td>
                                                <?php echo htmlspecialchars($item['name']); ?> 
                                                (Màu: <?php echo htmlspecialchars($item['color_name']); ?>, Size: <?php echo htmlspecialchars($item['size']); ?>) 
                                                <strong>× <?php echo $item['quantity']; ?></strong>
                                            </td>
                                            <td><?php echo number_format($item['price'] * $item['quantity'], 0); ?> VND</td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <tr>
                                            <td>phí vận chuyển</td>
                                            <td>30.000 VND</td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tổng cộng</th>
                                        <td><strong><?php echo number_format($total, 0); ?> VND</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>

    <script src="../assets/js/main.js"></script>
    <script>
    $(document).ready(function() {
        $('#checkout-form').on('submit', function(e) {
            console.log('Checkout form submitted');
            var formData = $(this).serialize();
            console.log('Form data:', formData);
            console.log('Form action:', $(this).attr('action'));
        });
    });
    </script>
</body>
</html>