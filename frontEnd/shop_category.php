<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Danh mục sản phẩm</title>
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
    <?php include 'includes/header.php'; ?>
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.php">trang chủ</a></li>
                            <li>/</li>
                            <li>cửa hàng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    
    <!--shop area start-->
    <div class="shop_area shop_reverse">
        <div class="container">
            <div class="shop_inner_area">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <!--sidebar widget start-->
                        <div class="sidebar_widget">
                            <div class="widget_list widget_filter">
                                <h2>Lọc theo giá</h2>
                                <form action="#"> 
                                    <div id="slider-range"></div>   
                                    <button type="submit">Lọc</button>
                                    <input type="text" name="text" id="amount" />   
                                </form> 
                            </div>
                            <div class="widget_list widget_categories">
                                <h2>Danh mục sản phẩm</h2>
                                <ul>
                                    <?php
                                    // Lấy danh mục từ cơ sở dữ liệu
                                    $result = $conn->query("SELECT id, name FROM categories");
                                    while ($category = $result->fetch_assoc()) {
                                        echo "<li><a href='shop_category.php?category={$category['id']}'>{$category['name']}</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="widget_list widget_categories">
                                <h2>Lọc theo màu sắc</h2>
                                <ul>
                                    <?php
                                    // Lấy màu sắc từ cơ sở dữ liệu
                                    $result = $conn->query("SELECT id, name FROM color");
                                    while ($color = $result->fetch_assoc()) {
                                        echo "<li><a href='shop_category.php?color={$color['id']}'>{$color['name']}</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!--sidebar widget end-->
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <!--shop wrapper start-->
                        <!--shop toolbar start-->
                        <div class="shop_title">
                            <h1>Cửa hàng</h1>
                        </div>
                        <div class="shop_toolbar_wrapper">
                            <div class="shop_toolbar_btn">
                                <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip" title="3"></button>
                                <button data-role="grid_4" type="button" class="btn-grid-4" data-toggle="tooltip" title="4"></button>
                                <button data-role="grid_5" type="button" class="btn-grid-5" data-toggle="tooltip" title="5"></button>
                                <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip" title="Danh sách"></button>
                            </div>
                            <div class="niceselect_option">
                                <form class="select_option" action="#">
                                    <select name="orderby" id="short">
                                        <option selected value="1">Sắp xếp theo đánh giá trung bình</option>
                                        <option value="2">Sắp xếp theo độ phổ biến</option>
                                        <option value="3">Sắp xếp theo mới nhất</option>
                                        <option value="4">Sắp xếp theo giá: thấp đến cao</option>
                                        <option value="5">Sắp xếp theo giá: cao đến thấp</option>
                                        <option value="6">Tên sản phẩm: Z</option>
                                    </select>
                                </form>
                            </div>
                            <div class="page_amount">
                                <?php
                                // Đếm tổng số sản phẩm
                                $total_query = "SELECT COUNT(*) as total FROM products p";
                                $conditions = [];
                                $params = [];

                                // Lọc theo danh mục nếu có
                                if (isset($_GET['category'])) {
                                    $total_query .= " JOIN subcategories s ON p.subcategories_id = s.id";
                                    $conditions[] = "s.category_id = ?";
                                    $params[] = (int)$_GET['category'];
                                }

                                // Lọc theo màu sắc nếu có
                                if (isset($_GET['color'])) {
                                    $conditions[] = "p.id IN (
                                        SELECT id_product FROM products_size_color WHERE id_color = ?
                                    )";
                                    $params[] = (int)$_GET['color'];
                                }

                                // Thêm điều kiện vào truy vấn tổng
                                if (!empty($conditions)) {
                                    $total_query .= " WHERE " . implode(" AND ", $conditions);
                                }

                                $stmt = $conn->prepare($total_query);
                                if (!empty($params)) {
                                    $types = str_repeat('i', count($params));
                                    $stmt->bind_param($types, ...$params);
                                }
                                $stmt->execute();
                                $total_result = $stmt->get_result();
                                $total_products = $total_result->fetch_assoc()['total'];
                                $stmt->close();

                                // Tính số trang
                                $products_per_page = 9;
                                $total_pages = ceil($total_products / $products_per_page);

                                // Xác định trang hiện tại
                                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                if ($current_page < 1) $current_page = 1;
                                if ($current_page > $total_pages) $current_page = $total_pages;
                                ?>
                                <p>Hiển thị <?php echo ($current_page - 1) * $products_per_page + 1; ?>–<?php echo min($current_page * $products_per_page, $total_products); ?> trong <?php echo $total_products; ?> kết quả</p>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                        
                        <div class="row shop_wrapper">
                            <?php
                            // Truy vấn lấy sản phẩm
                            $query = "SELECT p.id, p.name, p.description, p.price, p.image_url_1, p.created_at 
                                      FROM products p 
                                      JOIN subcategories s ON p.subcategories_id = s.id";
                            $conditions = [];
                            $params = [];

                            // Lọc theo danh mục nếu có
                            if (isset($_GET['category'])) {
                                $conditions[] = "s.category_id = ?";
                                $params[] = (int)$_GET['category'];
                            }

                            // Lọc theo màu sắc nếu có
                            if (isset($_GET['color'])) {
                                $conditions[] = "p.id IN (
                                    SELECT id_product FROM products_size_color WHERE id_color = ?
                                )";
                                $params[] = (int)$_GET['color'];
                            }

                            // Thêm điều kiện vào truy vấn
                            if (!empty($conditions)) {
                                $query .= " WHERE " . implode(" AND ", $conditions);
                            }

                            // Thêm phân trang
                            $offset = ($current_page - 1) * $products_per_page;
                            $query .= " LIMIT 9 OFFSET $offset";

                            // Chuẩn bị truy vấn
                            $stmt = $conn->prepare($query);
                            if (!empty($params)) {
                                $types = str_repeat('i', count($params));
                                $stmt->bind_param($types, ...$params);
                            }
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Lặp qua các sản phẩm và hiển thị
                            while ($product = $result->fetch_assoc()) {
                                ?>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.php?id=<?php echo $product['id']; ?>">
                                                <img src="<?php echo htmlspecialchars($product['image_url_1']); ?>" alt="">
                                            </a>
                                            <div class="quick_button">
                                                <a href="product-details.php?id=<?php echo $product['id']; ?>" title="quick_view">Xem sản phẩm</a>
                                            </div>
                                            <?php if (strtotime($product['created_at']) > strtotime('-7 days')) { ?>
                                                <div class="label_product">
                                                    <span>Mới</span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="product_content grid_content">
                                            <h3><a href="product-details.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                                            <span class="current_price"><?php echo number_format($product['price'], 0); ?> VND</span>
                                        </div>
                                        <div class="product_content list_content">
                                            <h3><a href="product-details.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                                            <div class="product_price">
                                                <span class="current_price"><?php echo number_format($product['price'], 0); ?> VND</span>
                                            </div>
                                            <div class="product_desc">
                                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            $stmt->close();
                            ?>
                        </div>
                        
                        <!-- Phân trang -->
                        <div class="shop_toolbar t_bottom">
                            <div class="pagination">
                                <ul>
                                    <?php
                                    // Liên kết "Trang trước"
                                    if ($current_page > 1) {
                                        $prev_page = $current_page - 1;
                                        $filter_params = http_build_query(array_merge($_GET, ['page' => $prev_page]));
                                        echo "<li><a href='shop_category.php?$filter_params'>Trang trước</a></li>";
                                    }

                                    // Hiển thị số trang
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $filter_params = http_build_query(array_merge($_GET, ['page' => $i]));
                                        if ($i == $current_page) {
                                            echo "<li class='current'>$i</li>";
                                        } else {
                                            echo "<li><a href='shop_category.php?$filter_params'>$i</a></li>";
                                        }
                                    }

                                    // Liên kết "Trang sau"
                                    if ($current_page < $total_pages) {
                                        $next_page = $current_page + 1;
                                        $filter_params = http_build_query(array_merge($_GET, ['page' => $next_page]));
                                        echo "<li><a href='shop_category.php?$filter_params'>Trang sau</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                        <!--shop wrapper end-->
                    </div>
                </div>
            </div>   
        </div>
    </div>
    <!--shop area end-->
    
    <!--footer area start-->
    <?php include "includes/footer.php"; ?>
    <!--footer area end-->
    
    <!-- modal area start-->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- Nội dung modal giữ nguyên -->
    </div>
    <!-- modal area end-->
    
    <!-- JS -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>