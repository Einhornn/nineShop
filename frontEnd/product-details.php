<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sản phẩm</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <?php 
    include "includes/header.php"; // Include kết nối cơ sở dữ liệu

    // Lấy chi tiết sản phẩm dựa trên ID
    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $stmt = $conn->prepare("
        SELECT p.id, p.name, p.description, p.price, p.image_url_1, p.subcategories_id, s.category_id
        FROM products p
        JOIN subcategories s ON p.subcategories_id = s.id
        WHERE p.id = ?
    ");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        die("Không tìm thấy sản phẩm.");
    }

    // Lấy sản phẩm liên quan (cùng danh mục phụ)
    $stmt = $conn->prepare("
        SELECT id, name, price, image_url_1
        FROM products
        WHERE subcategories_id = ? AND id != ?
        LIMIT 4
    ");
    $stmt->bind_param("ii", $product['subcategories_id'], $product_id);
    $stmt->execute();
    $related_result = $stmt->get_result();
    $related_products = [];
    while ($row = $related_result->fetch_assoc()) {
        $related_products[] = $row;
    }
    $stmt->close();

    // Lấy sản phẩm đề xuất (cùng danh mục nhưng khác danh mục phụ)
    $stmt = $conn->prepare("
        SELECT p.id, p.name, p.price, p.image_url_1
        FROM products p
        JOIN subcategories s ON p.subcategories_id = s.id
        WHERE s.category_id = ? AND p.subcategories_id != ? AND p.id != ?
        LIMIT 4
    ");
    $stmt->bind_param("iii", $product['category_id'], $product['subcategories_id'], $product_id);
    $stmt->execute();
    $upsell_result = $stmt->get_result();
    $upsell_products = [];
    while ($row = $upsell_result->fetch_assoc()) {
        $upsell_products[] = $row;
    }
    $stmt->close();

    // Lấy màu sắc mặc định (màu đầu tiên có sẵn, sử dụng DISTINCT để tránh trùng lặp)
    $stmt = $conn->prepare("
        SELECT DISTINCT c.id, c.name 
        FROM color c
        JOIN products_size_color psc ON c.id = psc.id_color
        WHERE psc.id_product = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $default_color = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $default_color_id = $default_color ? $default_color['id'] : 0;

    // Lấy kích cỡ mặc định (kích cỡ đầu tiên có sẵn cho màu mặc định)
    $stmt = $conn->prepare("
        SELECT s.id, s.size 
        FROM size s
        JOIN products_size_color psc ON s.id = psc.id_size
        WHERE psc.id_product = ? AND psc.id_color = ?
        LIMIT 1
    ");
    $stmt->bind_param("ii", $product_id, $default_color_id);
    $stmt->execute();
    $default_size = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $default_size_id = $default_size ? $default_size['id'] : 0;

    // Lấy số lượng mặc định dựa trên màu và kích cỡ mặc định
    $stmt = $conn->prepare("
        SELECT quantity 
        FROM products_size_color 
        WHERE id_product = ? AND id_color = ? AND id_size = ?
    ");
    $stmt->bind_param("iii", $product_id, $default_color_id, $default_size_id);
    $stmt->execute();
    $quantity_result = $stmt->get_result()->fetch_assoc();
    $available_quantity = $quantity_result ? (int)$quantity_result['quantity'] : 0;
    $stmt->close();
    ?>

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area product_bread">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.php">trang chủ</a></li>
                            <li>/</li>
                            <li>chi tiết sản phẩm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    
    <!--product details start-->
    <div class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="<?php echo htmlspecialchars($product['image_url_1']); ?>" data-zoom-image="<?php echo htmlspecialchars($product['image_url_1']); ?>" alt="big-1">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="product_d_right">
                        <form action="cart.php" method="POST" id="add-to-cart-form">
                            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                            <div class="product_price">
                                <span class="current_price"><?php echo number_format($product['price'], 0); ?> VND</span>
                            </div>
                            <div class="product_desc">
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                            </div>
                            <div class="product_variant color">
                                <h3>Màu sắc</h3>
                                <select class="niceselect_option" id="color" name="color_id">
                                    <?php
                                    // Lấy các màu sắc có sẵn cho sản phẩm, sử dụng DISTINCT để tránh trùng lặp
                                    $stmt = $conn->prepare("
                                        SELECT DISTINCT c.id, c.name 
                                        FROM color c
                                        JOIN products_size_color psc ON c.id = psc.id_color
                                        WHERE psc.id_product = ?
                                    ");
                                    $stmt->bind_param("i", $product_id);
                                    $stmt->execute();
                                    $color_result = $stmt->get_result();
                                    while ($color = $color_result->fetch_assoc()) {
                                        $selected = ($color['id'] == $default_color_id) ? 'selected' : '';
                                        echo "<option value='{$color['id']}' $selected>{$color['name']}</option>";
                                    }
                                    $stmt->close();
                                    ?>
                                </select>   
                            </div>
                            <div class="product_variant size">
                                <h3>Kích cỡ</h3>
                                <select id="size" name="size_id">
                                <?php
                                    // Lấy các kích cỡ có sẵn cho màu mặc định
                                    $stmt = $conn->prepare("
                                        SELECT s.id, s.size 
                                        FROM size s
                                        JOIN products_size_color psc ON s.id = psc.id_size
                                        WHERE psc.id_product = ? AND psc.id_color = ?
                                    ");
                                    $stmt->bind_param("ii", $product_id, $default_color_id);
                                    $stmt->execute();
                                    $size_result = $stmt->get_result();
                                    while ($size = $size_result->fetch_assoc()) {
                                        $selected = ($size['id'] == $default_size_id) ? 'selected' : '';
                                        echo "<option value='{$size['id']}' $selected>{$size['size']}</option>";
                                    }
                                    $stmt->close();
                                    ?>
                                </select> 
                            </div>
                            <div class="product_variant quantity">
                                <label>Số lượng</label>
                                <input min="1" max="<?php echo $available_quantity; ?>" value="1" type="number" name="quantity" id="quantity" <?php echo $available_quantity == 0 ? 'disabled' : ''; ?>>
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button class="button" type="submit" <?php echo $available_quantity == 0 ? 'disabled' : ''; ?>>Thêm vào giỏ hàng</button>
                                <?php if ($available_quantity == 0) { ?>
                                    <p style="color: red;">Hết hàng</p>
                                <?php } else { ?>
                                    <p>Còn lại: <span id="available-quantity"><?php echo $available_quantity; ?></span> sản phẩm</p>
                                <?php } ?>
                            </div>
                        </form>
                        <div class="priduct_social">
                            <h3>Chia sẻ:</h3>
                            <ul>
                                <li><a href="#"><i class="fa fa-rss"></i></a></li>           
                                <li><a href="#"><i class="fa fa-vimeo"></i></a></li>           
                                <li><a href="#"><i class="fa fa-tumblr"></i></a></li>           
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>        
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>        
                            </ul>      
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!--product details end-->
    
    <!--product info start-->
    <div class="product_d_info">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">   
                        <div class="product_info_button">    
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Thông tin thêm</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="product_info_content">
                                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                                </div>    
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="product_info_content">
                                    <?php
                                    // Lấy đánh giá cho sản phẩm
                                    $stmt = $conn->prepare("
                                        SELECT r.rating, r.comment, r.created_at, u.name
                                        FROM reviews r
                                        JOIN users u ON r.user_id = u.id
                                        WHERE r.product_id = ?
                                    ");
                                    $stmt->bind_param("i", $product_id);
                                    $stmt->execute();
                                    $review_result = $stmt->get_result();
                                    while ($review = $review_result->fetch_assoc()) {
                                        echo "<div class='product_ratting mb-10'>";
                                        echo "<ul>";
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo "<li><a href='#'><i class='fa fa-star" . ($i <= $review['rating'] ? '' : '-o') . "'></i></a></li>";
                                        }
                                        echo "</ul>";
                                        echo "<strong>{$review['name']}</strong>";
                                        echo "<p>" . date('d/m/Y', strtotime($review['created_at'])) . "</p>";
                                        echo "</div>";
                                        echo "<div class='product_demo'>";
                                        echo "<strong>Bình luận</strong>";
                                        echo "<p>" . htmlspecialchars($review['comment']) . "</p>";
                                        echo "</div>";
                                    }
                                    $stmt->close();
                                    ?>
                                </div>
                                <div class="product_review_form">
                                    <form action="submit_review.php" method="POST">
                                        <h2>Thêm đánh giá</h2>
                                        <p>Địa chỉ email của bạn sẽ không được công khai. Các trường bắt buộc được đánh dấu</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="review_comment">Đánh giá của bạn</label>
                                                <textarea name="comment" id="review_comment"></textarea>
                                            </div> 
                                            <div class="col-lg-6 col-md-6">
                                                <label for="author">Tên</label>
                                                <input id="author" name="name" type="text">
                                            </div> 
                                            <div class="col-lg-6 col-md-6">
                                                <label for="email">Email</label>
                                                <input id="email" name="email" type="text">
                                            </div>  
                                            <div class="col-lg-6 col-md-6">
                                                <label for="rating">Đánh giá</label>
                                                <select name="rating" id="rating">
                                                    <option value="1">1 Sao</option>
                                                    <option value="2">2 Sao</option>
                                                    <option value="3">3 Sao</option>
                                                    <option value="4">4 Sao</option>
                                                    <option value="5">5 Sao</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <button type="submit">Gửi</button>
                                    </form>   
                                </div>     
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>    
    </div>  
    <!--product info end-->
    
    <!--product section area start-->
    <section class="product_section related_product">
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="section_title">
                        <h2>Sản phẩm liên quan</h2>
                        <p>Thiết kế hiện đại, tối giản và tinh tế thể hiện phong cách của Lavish Alice</p>
                    </div>
                </div> 
            </div>    
            <div class="product_area"> 
                <div class="row">
                    <div class="product_carousel product_three_column4 owl-carousel">
                        <?php foreach ($related_products as $related) { ?>
                            <div class="col-lg-3">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.php?id=<?php echo $related['id']; ?>">
                                            <img src="<?php echo htmlspecialchars($related['image_url_1']); ?>" alt="">
                                        </a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="quick_view">+ xem nhanh</a>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.php?id=<?php echo $related['id']; ?>"><?php echo htmlspecialchars($related['name']); ?></a></h3>
                                        <span class="current_price"><?php echo number_format($related['price'], 0); ?> VND</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product section area end-->
    
    <!--product section area start-->
    <section class="product_section upsell_product">
        <div class="container">
            <div class="row">   
                <div class="col-12">
                    <div class="section_title">
                        <h2>Sản phẩm đề xuất</h2>
                        <p>Thiết kế hiện đại, tối giản và tinh tế thể hiện phong cách của Lavish Alice</p>
                    </div>
                </div> 
            </div>    
            <div class="product_area"> 
                <div class="row">
                    <div class="product_carousel product_three_column4 owl-carousel">
                        <?php foreach ($upsell_products as $upsell) { ?>
                            <div class="col-lg-3">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.php?id=<?php echo $upsell['id']; ?>">
                                            <img src="<?php echo htmlspecialchars($upsell['image_url_1']); ?>" alt="">
                                        </a>
                                        <div class="quick_button">
                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="quick_view">+ xem nhanh</a>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.php?id=<?php echo $upsell['id']; ?>"><?php echo htmlspecialchars($upsell['name']); ?></a></h3>
                                        <span class="current_price"><?php echo number_format($upsell['price'], 0); ?> VND</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product section area end-->
    
    <!--footer area start-->
    <?php include 'includes/footer.php'; ?>
    <!--footer area end-->
    
    <!-- modal area start-->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- Nội dung modal giữ nguyên -->
    </div>
    <!-- modal area end-->
    
    <!-- JS -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>
    $(document).ready(function() {
        $('#color').on('change', function() {
            var productId = <?php echo $product_id; ?>;
            var colorId = $(this).val();
            console.log('Color changed:', { productId: productId, colorId: colorId });

            $.ajax({
                url: '../backEnd/get_sizes.php',
                type: 'POST',
                data: { product_id: productId, color_id: colorId },
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);
                    var sizeSelect = $('#size');
                    var quantityInput = $('#quantity');
                    var addToCartButton = $('button[type="submit"]');
                    var availableQuantitySpan = $('#available-quantity');
                    var outOfStockMessage = $('p[style="color: red;"]');

                    // Xóa các kích cỡ hiện tại
                    
                    sizeSelect.empty();

                    if (response.sizes && response.sizes.length > 0) {
                        // Thêm các kích cỡ mới
                        $.each(response.sizes, function(index, size) {
                            console.log('Appending size:', size);
                            sizeSelect.append($('<option>', {
                                value: size.id,
                                text: size.size
                            }));
                        });

                        // Cập nhật số lượng
                        quantityInput.attr('max', response.quantity).val(1);
                        availableQuantitySpan.text(response.quantity);
                        quantityInput.prop('disabled', false);
                        addToCartButton.prop('disabled', false);

                        if (outOfStockMessage.length) {
                            outOfStockMessage.hide();
                        }
                    } else {
                        // Hiển thị thông báo hết hàng
                        console.log('No sizes available');
                        sizeSelect.append($('<option>', {
                            value: '',
                            text: 'Không có kích cỡ',
                            disabled: true,
                            selected: true
                        }));
                        quantityInput.prop('disabled', true);
                        addToCartButton.prop('disabled', true);
                        availableQuantitySpan.text('0');
                        if (outOfStockMessage.length) {
                            outOfStockMessage.show();
                        } else {
                            $('<p>', { css: { color: 'red' }, text: 'Hết hàng' })
                                .appendTo(quantityInput.parent());
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error, xhr.responseText);
                }
            });
        });

        $('#size').on('change', function() {
            var productId = <?php echo $product_id; ?>;
            var colorId = $('#color').val();
            var sizeId = $(this).val();
            console.log('Size changed:', { productId: productId, colorId: colorId, sizeId: sizeId });

            $.ajax({
                url: '../backEnd/get_quantity.php',
                type: 'POST',
                data: { product_id: productId, color_id: colorId, size_id: sizeId },
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);
                    var quantityInput = $('#quantity');
                    var addToCartButton = $('button[type="submit"]');
                    var availableQuantitySpan = $('#available-quantity');
                    var outOfStockMessage = $('p[style="color: red;"]');

                    if (response.quantity > 0) {
                        quantityInput.attr('max', response.quantity).val(1);
                        availableQuantitySpan.text(response.quantity);
                        quantityInput.prop('disabled', false);
                        addToCartButton.prop('disabled', false);

                        if (outOfStockMessage.length) {
                            outOfStockMessage.hide();
                        }
                    } else {
                        quantityInput.prop('disabled', true);
                        addToCartButton.prop('disabled', true);
                        availableQuantitySpan.text('0');
                        if (outOfStockMessage.length) {
                            outOfStockMessage.show();
                        } else {
                            $('<p>', { css: { color: 'red' }, text: 'Hết hàng' })
                                .appendTo(quantityInput.parent());
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error, xhr.responseText);
                }
            });
        });

        $('#add-to-cart-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log('Form data:', formData);

            $.ajax({
                url: '../backEnd/add-to-cart.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Response from add-to-cart:', response);
                    if (response.success) {
                        $('<div>', {
                            class: 'alert alert-success',
                            text: response.message
                        }).prependTo('.product_d_right').fadeOut(5000);
                    } else {
                        $('<div>', {
                            class: 'alert alert-danger',
                            text: response.message
                        }).prependTo('.product_d_right').fadeOut(5000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error in add-to-cart:', status, error, xhr.responseText);
                    $('<div>', {
                        class: 'alert alert-danger',
                        text: 'Lỗi khi thêm vào giỏ hàng. Vui lòng thử lại.'
                    }).prependTo('.product_d_right').fadeOut(5000);
                }
            });
        });
    });
    </script>
</body>
</html>