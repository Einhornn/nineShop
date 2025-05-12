<!doctype html>
<html class="no-js" lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giỏ hàng</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>

<body>
    <?php
    include "includes/header.php";

    $user_id = (int)$_SESSION['user_id'];
    $subtotal = 0;
    $shipping = 30000; // Phí vận chuyển cố định

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

    $total = $subtotal + $shipping;
    ?>

    <div class="breadcrumbs_area other_bread">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.php">trang chủ</a></li>
                            <li>/</li>
                            <li>giỏ hàng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>

    <div class="shopping_cart_area">
        <div class="container">  
            <form action="../backEnd/update-cart.php" method="POST"> 
                <div class="row">
                    <div class="col-12">
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success">
                                <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Xóa</th>
                                            <th class="product_thumb">Hình ảnh</th>
                                            <th class="product_name">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product_quantity">Số lượng</th>
                                            <th class="product_total">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($cart_items)): ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống!</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($cart_items as $item): ?>
                                                <tr>
                                                    <td class="product_remove">
                                                        <a href="../backEnd/update-cart.php?action=delete&cart_id=<?php echo $item['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </td>
                                                    <td class="product_thumb">
                                                        <a href="product-details.php?id=<?php echo $item['product_id']; ?>">
                                                            <img src="<?php echo htmlspecialchars($item['image_url_1']); ?>" alt="">
                                                        </a>
                                                    </td>
                                                    <td class="product_name">
                                                        <a href="product-details.php?id=<?php echo $item['product_id']; ?>">
                                                            <?php echo htmlspecialchars($item['name']); ?> 
                                                            (Màu: <?php echo htmlspecialchars($item['color_name']); ?>, Size: <?php echo htmlspecialchars($item['size']); ?>)
                                                        </a>
                                                    </td>
                                                    <td class="product-price"><?php echo number_format($item['price'], 0); ?> VND</td>
                                                    <td class="product_quantity">
                                                        <input min="1" max="100" value="<?php echo $item['quantity']; ?>" type="number" name="quantity[<?php echo $item['id']; ?>]">
                                                    </td>
                                                    <td class="product_total"><?php echo number_format($item['price'] * $item['quantity'], 0); ?> VND</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>   
                            </div>  
                            <?php if (!empty($cart_items)): ?>
                                <div class="cart_submit">
                                    <button type="submit" name="update_cart">Cập nhật giỏ hàng</button>
                                </div>      
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>

            <div class="coupon_area">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="coupon_code right">
                            <h3>Tổng giỏ hàng</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Tạm tính</p>
                                    <p class="cart_amount"><?php echo number_format($subtotal, 0); ?> VND</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Phí vận chuyển</p>
                                    <p class="cart_amount"><?php echo number_format($shipping, 0); ?> VND</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Tổng cộng</p>
                                    <p class="cart_amount"><?php echo number_format($total, 0); ?> VND</p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="checkout.php">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>