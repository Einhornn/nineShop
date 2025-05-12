<?php
session_start();
include '../backEnd/config-database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <div class="offcanvas_menu">
                <div class="canvas_open">
                                <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                            </div>
                            <div class="offcanvas_menu_wrapper">
                            <div class="top_right">
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="my-account.php"><?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                <?php else: ?>
                    <li><a href="login.php">Đăng nhập/Đăng ký</a></li>
                <?php endif; ?>
            </ul>
        </div>
        </div>
    </div>
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
                        <a href="index.php"><img src="../assets/img/logo/1.logo.jpg" alt=""></a>
                    </div>
                </div>
                
                <div class="col-lg-4 account-wrapper">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="user-account">
                            <a href="my-account.php"><i class="fa fa-user"></i> 
                                <span class="account-text"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                            </a>
                            <div class="account-dropdown">
                                <ul>
                                    <li><a href="my-account.php">Tài khoản</a></li>
                                    <li><a href="cart.php">Giỏ hàng</a></li>
                                    <li><a href="logout.php" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="user-login">
                            <a href="login.php"><i class="fa fa-user"></i> Đăng nhập</a>
                        </div>
                    <?php endif; ?>
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
                                        <li class="active"><a href="index.php">Trang chủ </a></li>
                                        <li><a href="shop_category.php">Danh mục <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a href="#">Áo</a></li>
                                                <li><a href="#">Quần</a></li>
                                                <li><a href="#">Áo khoác</a></li>
                                                <li><a href="#">Đồ lót</a></li>
                                                <li><a href="#">Phụ kiện khác</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="shop_category.php">Sản phẩm </a></li>
                                        <li><a href="about.php">About us</a></li>
                                        <li><a href="contact.php">Liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    </body>