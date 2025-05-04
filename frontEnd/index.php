<?php include 'header.php'; ?>
<!-- <?php
    if (isset($_SESSION['user_name'])) {
        echo "<h2>Xin chào, " . htmlspecialchars($_SESSION['user_name']) . "!</h2>";
        echo "<a href='logout.php'>Đăng xuất</a>";
    } else {
        echo "<h2>Chào mừng đến với trang web!</h2>";
        echo "<a href='login.php'>Đăng nhập</a>";
    }
    ?> -->
    <div class="off_canvars_overlay">
    </div>
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
                <div class="col-lg-4">
    <div class="cart_area">
        <div class="account_area">
            <div class="account_link">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-account">
                        <a href="my-account.php"><i class="fa fa-user"></i> <span class="account-text"><?= htmlspecialchars($_SESSION['user_name']) ?></span></a>
                        <div class="account-dropdown">
                            <ul>
                                <li><a href="my-account.php">Tài khoản</a></li>
                                <li><a href="cart.php">Giỏ hàng</a></li>
                                <li><a href="logout.php">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Hiển thị nút Đăng nhập khi chưa đăng nhập -->
                    <a href="login.php"><i class="fa fa-user"></i> Đăng nhập</a>
                <?php endif; ?>
            </div>
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

    <div class="slider_area slider_style home_three_slider owl-carousel">
        <div class="single_slider" data-bgimg="../assets/img/slider/slider4.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_one">
                            <!-- <img src="../assets/img/slider/content3.png" alt=""> -->
                            <p>Trang phục tạo nên quý ông</p>
                            <a href="shop.php">Khám phá ngay</a>
                        </div>    
                    </div>
                </div>
            </div>    
        </div>
        <div class="single_slider" data-bgimg="../assets/img/slider/slider5.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_two">
                            <img src="../assets/img/slider/content4.png" alt="">
                            <p>the wooboom clothing summer collection is back at half price</p>
                            <a href="shop.php">Discover Now</a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider" data-bgimg="../assets/img/slider/slider6.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_three">
                            <img src="../assets/img/slider/content5.png" alt="">
                            <p>the wooboom clothing summer collection is back at half price</p>
                            <a href="shop.php">Discover Now</a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--slider area end-->

    <!--banner area start-->
    <div class="banner_section banner_section_three">
        <div class="container-fluid">
            <div class="row ">
               <div class="col-lg-4 col-md-6">
                    <div class="banner_area">
                        <div class="banner_thumb">
                            <a href="shop.php"><img src="../assets/img/bg/banner8.jpg" alt="#"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner_area">
                        <div class="banner_thumb">
                            <a href="shop.php"><img src="../assets/img/bg/banner9.jpg" alt="#"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner_area bottom">
                        <div class="banner_thumb">
                            <a href="shop.php"><img src="../assets/img/bg/banner10.jpg" alt="#"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--banner area end-->

    <!--product section area start-->
    <section class="product_section womens_product">
        <div class="container">
            <div class="row">   
                <div class="col-12">
                   <div class="section_title">
                       <h2>Sản phẩm của chúng tôi</h2>
                   </div>
                </div> 
            </div>    
            <div class="product_area"> 
                <div class="row">
                    <div class="col-12">
                        <div class="product_tab_button">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#clothing" role="tab" aria-controls="clothing" aria-selected="true">Áo</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#handbag" role="tab" aria-controls="handbag" aria-selected="false">Quần</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#shoes" role="tab" aria-controls="shoes" aria-selected="false">Áo khoác</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#accessories" role="tab" aria-controls="accessories" aria-selected="false">Khác</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                 <div class="tab-content">
                      <div class="tab-pane fade show active" id="clothing" role="tabpanel">
                             <div class="product_container">
                                <div class="row product_column4">
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product21.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product22.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">930.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Koss KPH7 Portable</a></h3>
                                                <span class="current_price">£60.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <div class="double_base">
                                                    <div class="product_sale">
                                                        <span>-7%</span>
                                                    </div>
                                                    <div class="label_product">
                                                        <span>new</span>
                                                    </div>
                                                </div>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">1.200.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">890.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product7.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product8.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">750.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>-10%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">690.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product1.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product2.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">450.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product7.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product8.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">800.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane fade" id="handbag" role="tabpanel">
                            <div class="product_container">
                                <div class="row product_column4">
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product7.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product8.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">800.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">890.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product7.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product8.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">750.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>-10%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">690.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product1.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product2.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">450.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product7.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product8.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">800.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product1.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product2.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" title="quick_view">Xem sản phẩm</a>
                                        </div>
                                        <div class="label_product">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.php">Quần áo</a></h3>
                                        <span class="current_price">450.000 VND</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" title="quick_view">Xem sản phẩm</a>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.php">Quần áo</a></h3>
                                        <span class="current_price">550.000 VND</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                        <div class="quick_button">
                                            <a href="#" title="quick_view">Xem sản phẩm</a>
                                        </div>
                                        <div class="label_product">
                                            <span>-10%</span>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <h3><a href="product-details.php">Quần áo</a></h3>
                                        <span class="current_price">690.000 VND</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">550.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                      </div> 
                        <div class="tab-pane fade" id="shoes" role="tabpanel">
                             <div class="product_container">
                                <div class="row product_column4">
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product11.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product12.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>-15%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">640.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product9.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product10.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">720.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product11.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product12.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>-15%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">640.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product17.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product18.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">760.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product15.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product16.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">580.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product11.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product12.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>-15%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">640.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product13.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product14.jpg" alt=""></a>
                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">890.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product15.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product16.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>

                                                <div class="product_sale">
                                                    <span>-7%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Quần áo</a></h3>
                                                <span class="current_price">890.000 VND</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product18.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product17.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Apple iPad with Retina</a></h3>
                                                <span class="current_price">£60.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product19.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product20.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>

                                                <div class="product_sale">
                                                    <span>-7%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Marshall Portable  Bluetooth</a></h3>
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£86.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>  
                      <div class="tab-pane fade" id="accessories" role="tabpanel">
                             <div class="product_container">
                                <div class="row product_column4">
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product1.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product2.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>

                                                <div class="product_sale">
                                                    <span>-7%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Marshall Portable  Bluetooth</a></h3>
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£86.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product4.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product3.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>

                                                <div class="product_sale">
                                                    <span>-7%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Koss KPH7 Portable</a></h3>
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£86.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Beats Solo2 Solo 2</a></h3>
                                                <span class="current_price">£60.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product7.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product8.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Beats EP Wired</a></h3>
                                                <span class="current_price">£60.00</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product10.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product9.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Bose SoundLink Bluetooth</a></h3>
                                                <span class="current_price">£60.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product10.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product11.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Apple iPhone SE 16GB</a></h3>
                                                <span class="current_price">£60.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product13.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product14.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="double_base">
                                                    <div class="product_sale">
                                                        <span>-7%</span>
                                                    </div>
                                                    <div class="label_product">
                                                        <span>new</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">JBL Flip 3 Portable</a></h3>
                                                <span class="current_price">£60.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product15.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product16.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>

                                                <div class="product_sale">
                                                    <span>-7%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Beats Solo Wireless</a></h3>
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£86.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>
                                                <div class="label_product">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Áo len nam cổ lọ màu nâu</a></h3>
                                                <span class="current_price">159.000</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product19.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product20.jpg" alt=""></a>

                                                <div class="quick_button">
                                                    <a href="#" title="quick_view">Xem sản phẩm</a>
                                                </div>

                                                <div class="product_sale">
                                                    <span>-7%</span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="product-details.php">Marshall Portable  Bluetooth</a></h3>
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£86.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div> 
                </div>
            </div>
               
        </div>
    </section>
    <!--product section area end-->
    <section class="product_section womens_product bottom">
        <div class="container">
            <div class="row">   
                <div class="col-12">
                   <div class="section_title">
                       <h2>Sản phẩm thịnh hành</h2>
                   </div>
                </div> 
            </div>
            <div class="product_area"> 
                 <div class="row">
                    <div class="product_carousel product_three_column4 owl-carousel">
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product21.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product22.jpg" alt=""></a>

                                    <div class="quick_button">
                                        <a href="#" title="quick_view">Xem sản phẩm</a>
                                    </div>

                                    <div class="product_sale">
                                        <span>-7%</span>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php">Giày nam màu nâu thanh lịch</a></h3>
                                    <span class="current_price">930.000</span>
                                    <span class="old_price">1.000.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product27.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product28.jpg" alt=""></a>

                                    <div class="quick_button">
                                        <a href="#" title="quick_view">Xem sản phẩm</a>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php">Áo khoác gió nam 2 màu</a></h3>
                                    <span class="current_price">160.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product6.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product5.jpg" alt=""></a>

                                    <div class="quick_button">
                                        <a href="#" title="quick_view">Xem sản phẩm</a>
                                    </div>

                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php">Áo len nam cổ lọ màu nâu</a></h3>
                                    <span class="current_price">159.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product7.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product8.jpg" alt=""></a>

                                    <div class="quick_button">
                                        <a href="#" title="quick_view">Xem sản phẩm</a>
                                    </div>

                                    <div class="product_sale">
                                        <span>-7%</span>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php">Áo khoác phao nam 2 màu</a></h3>
                                    <span class="current_price">818.000</span>
                                    <span class="old_price">879.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product24.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product25.jpg" alt=""></a>

                                    <div class="quick_button">
                                        <a href="#" title="quick_view">Xem sản phẩm</a>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php">Giày chạy bộ nam 2024 màu xám</a></h3>
                                    <span class="current_price">495.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product10.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product11.jpg" alt=""></a>

                                    <div class="quick_button">
                                        <a href="#" title="quick_view">Xem sản phẩm</a>
                                    </div>

                                    <div class="product_sale">
                                        <span>-7%</span>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php">Áo khoác cotton màu trắng</a></h3>
                                    <span class="current_price">930.000</span>
                                    <span class="old_price">1.000.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php"><img src="../assets/img/product/product23.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.php"><img src="../assets/img/product/product24.jpg" alt=""></a>

                                    <div class="quick_button">
                                        <a href="#" title="quick_view">Xem sản phẩm</a>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php">Giày chạy bộ nam 2024 màu xám</a></h3>
                                    <span class="current_price">495.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product section area end-->
    <!--footer area start-->
    <footer class="footer_widgets">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-sm-6 col-6">
                        <div class="widgets_container">
                            <h3>Thông tin</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="#">Chính sách vận chuyển</a></li>
                                    <li><a href="contact.php">Liên hệ</a></li>
                                    <li><a href="#">Đổi, trả hàng</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="widgets_container contact_us">
                            <h3>Nine Shop</h3>
                            <div class="footer_contact">
                                <p>Địa chỉ: 63 Dương Bá Trạc, Phường Rạch Ông, Quận 8</p>
                                <p>Hotline: <a href="tel:+(+84)394777031">(+84)394-777-031</a> </p>
                                <p>Email: manguyenanhkhoa@gmail.com</p>
                                <ul>
                                    <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#" title="TikTok"><i class="fa fa-tiktok"></i></a></li>
                                    <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" title="YouTube"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#" title="Shopee"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="widgets_container newsletter">
                            <h3>Tuyển dụng</h3>
                            <div class="newleter-content">
                                <p>Bạn có đam mê bán hàng, liên hệ chúng tôi ngay nhé!</p>
                                 <div class="subscribe_form">
                                    <form id="mc-form" class="mc-form footer-newsletter" >
                                        <input id="mc-email" type="email" autocomplete="off" placeholder="Điền email vào..." />
                                        <button id="mc-submit">Gửi!</button>
                                    </form>
                                    <div class="mailchimp-alerts text-centre">
                                        <div class="mailchimp-submitting"></div>
                                        <div class="mailchimp-success"></div>
                                        <div class="mailchimp-error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
               <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright_area">
                            <p> &copy; 2025 <strong> </strong> Admin ❤️<strong>Nhóm 9</strong></a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer_custom_links">
                            <ul>
                                <li><a href="#">Báo cáo</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'footer.php'; ?>