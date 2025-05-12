<?php include 'includes/header.php'; ?>
<!-- <?php
    if (isset($_SESSION['user_name'])) {
        echo "<h2>Xin chào, " . htmlspecialchars($_SESSION['user_name']) . "!</h2>";
        echo "<a href='logout.php'>Đăng xuất</a>";
    } else {
        echo "<h2>Chào mừng đến với trang web!</h2>";
        echo "<a href='login.php'>Đăng nhập</a>";
    }
    ?> -->
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
    <!-- modal area start-->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="modal_tab">  
                                    <div class="tab-content product-details-large">
                                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="../assets/img/product/product4.jpg" alt=""></a>    
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab2" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="../assets/img/product/product6.jpg" alt=""></a>    
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab3" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="../assets/img/product/product8.jpg" alt=""></a>    
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab4" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="../assets/img/product/product2.jpg" alt=""></a>    
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab5" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="../assets/img/product/product12.jpg" alt=""></a>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal_tab_button">    
                                        <ul class="nav product_navactive owl-carousel" role="tablist">
                                            <li >
                                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false"><img src="../assets/img/s-product/product3.jpg" alt=""></a>
                                            </li>
                                            <li>
                                                 <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><img src="../assets/img/s-product/product.jpg" alt=""></a>
                                            </li>
                                            <li>
                                               <a class="nav-link button_three" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><img src="../assets/img/s-product/product2.jpg" alt=""></a>
                                            </li>
                                            <li>
                                               <a class="nav-link" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><img src="../assets/img/s-product/product4.jpg" alt=""></a>
                                            </li>
                                            <li>
                                               <a class="nav-link" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false"><img src="../assets/img/s-product/product5.jpg" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>    
                                </div>  
                            </div> 
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="modal_right">
                                    <div class="modal_title mb-10">
                                        <h2>Handbag feugiat</h2> 
                                    </div>
                                    <div class="modal_price mb-10">
                                        <span class="new_price">$64.99</span>    
                                        <span class="old_price" >$78.99</span>    
                                    </div>
                                    <div class="modal_description mb-15">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel recusandae </p>    
                                    </div> 
                                    <div class="variants_selects">
                                        <div class="variants_size">
                                           <h2>size</h2>
                                           <select class="select_option">
                                               <option selected value="1">s</option>
                                               <option value="1">m</option>
                                               <option value="1">l</option>
                                               <option value="1">xl</option>
                                               <option value="1">xxl</option>
                                           </select>
                                        </div>
                                        <div class="variants_color">
                                           <h2>color</h2>
                                           <select class="select_option">
                                               <option selected value="1">purple</option>
                                               <option value="1">violet</option>
                                               <option value="1">black</option>
                                               <option value="1">pink</option>
                                               <option value="1">orange</option>
                                           </select>
                                        </div>
                                        <div class="modal_add_to_cart">
                                            <form action="#">
                                                <input min="0" max="100" step="2" value="1" type="number">
                                                <button type="submit">add to cart</button>
                                            </form>
                                        </div>   
                                    </div>
                                    <div class="modal_social">
                                        <h2>Share this product</h2>
                                        <ul>
                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>    
                                    </div>      
                                </div>    
                            </div>    
                        </div>     
                    </div>
                </div>    
            </div>
        </div>
    </div> 
    <!--footer area start-->
    <?php include 'includes/footer.php'; ?>



<script src="../assets/js/plugins.js"></script>

<script src="../assets/js/main.js"></script>