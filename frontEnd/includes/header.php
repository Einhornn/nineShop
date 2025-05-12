<?php
session_start();
include "../backEnd/config-database.php";
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nine Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico"> -->
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <header class="header_area header_three">
        <div class="header_top">
                <div class="header_center">
                    <p>Tưng bừng khai trương giảm giá lên tới 70%</p>
                </div>
        </div>
        <div class="header_middel">
            <div class="container-fluid">
                <div class="middel_inner">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="search_bar">
                                <form action="#">                          
                                    <input placeholder="Tìm kiếm..." type="text">
                                    <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="logo">
                                <a href="../frontEnd/index.php"><img src="../assets/img/logo/1.logo.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cart_area">
                                <div class="account_area">
                                    <div class="account_link">
                                        <?php if (isset($_SESSION['user_id'])): ?>
                                            <div class="user-account"  style="cursor: pointer;">
                                                <i class="fa fa-user"></i> <span class="account-text"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                                                <div class="account-dropdown">
                                                    <ul>
                                                        <li><a href="my-account.php">Tài khoản</a></li>
                                                        <li><a href="../frontEnd/cart.php">Giỏ hàng</a></li>
                                                        <li><a href="../backEnd/logout.php">Đăng xuất</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <!-- Hiển thị nút Đăng nhập khi chưa đăng nhập -->
                                            <a href="../frontEnd/login.php"><i class="fa fa-user"></i> Đăng nhập</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom sticky-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="main_menu_inner">
                                <div class="main_menu"> 
                                    <nav>
                                        <ul>
                                            <li class="active"><a href="../frontEnd/index.php">Trang chủ </a></li>
                                            <li><a href="../frontEnd/shop_category.php">Danh mục <i class="fa fa-angle-down"></i></a>
                                                <ul class="sub_menu pages">
                                                    <?php
                                                    // Lấy danh mục từ cơ sở dữ liệu
                                                    $result = $conn->query("SELECT id, name FROM categories");
                                                    while ($category = $result->fetch_assoc()) {
                                                        echo "<li><a href='shop_category.php?category={$category['id']}'>{$category['name']}</a></li>";
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <li><a href="../frontEnd/about.php">About us</a></li>
                                            <li><a href="../frontEnd/contact.php">Liên hệ</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>