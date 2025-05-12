<?php
function getProductsBySubcategory($conn, $subcategoryId) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE subcategories_id = ?");
    $stmt->bind_param("i", $subcategoryId); 
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProductImages($conn, $productId) {
    $stmt = $conn->prepare("SELECT image_url FROM product_images WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function showProducts($products, $conn) {
    foreach ($products as $product) {
        $images = getProductImages($conn, $product['id']);

        echo '
        <div class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                   <div class="product-details-tab">

                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img class="img-fluid w-100" id="main-product-image" src="' . htmlspecialchars($product['image_url']) . '" alt="">

                            </a>
                        </div>

                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">';

        
        foreach ($images as $img) {
            $imgUrl = htmlspecialchars($img['image_url']);
            echo '
                <li>
                        <a href="#" class="thumbnail-image elevatezoom-gallery" data-image="' . $imgUrl . '" data-zoom-image="' . $imgUrl . '">

                        <img src="' . $imgUrl . '" alt="thumbnail"/>
                    </a>
                </li>';
        }

        echo '
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="product_d_right">
                       <form action="#"> 
                            <h1><a class="h6 text-decoration-none text-truncate" href="product-details.php?id=' . $product['id'] . '">' . htmlspecialchars($product['name']) . '</a></h1>
                            <div class=" product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="review"><a href="#"> 1 đánh giá </a></li>
                                    <li class="review"><a href="#"> Viết đánh giá </a></li>
                                </ul>
                            </div>
                            <div class="product_price">
                                <h5 class="current_price">' . number_format($product['price'], 0, ',', '.') . ' đ</h5>
                            </div>

                            <div class="product_variant color">
                                <h3>Màu</h3>
                                <select class="niceselect_option" id="color" name="produc_color">
                                    <option selected value="1">Đỏ</option>        
                                    <option value="2">Đen</option>              
                                    <option value="3">Trắng</option>              
                                    <option value="4">Hồng</option>              
                                </select>   
                            </div>
                            <div class="product_variant size">
                                <h3>Kích thước</h3>
                                <select class="niceselect_option" id="size" name="product_size">
                                    <option value="">Chọn size</option>        
                                    <option value="s">S</option>              
                                    <option value="m">M</option>              
                                    <option value="l">L</option>              
                                    <option value="xl">XL</option>              
                                    <option value="xxl">XXL</option>              
                                </select>

                            </div>
                            <div class="product_variant quantity">
                                <label>Số lượng</label>
                                <input min="1" max="100" value="1" type="number">
                                <button class="button" type="submit">Thêm vào giỏ hàng</button>  
                            </div>
                            <div class=" product_d_action">
                               <ul>
                                   <li><a href="#" title="Yêu thích"><i class="fa fa-heart-o" aria-hidden="true"></i> Yêu thích</a></li>
                               </ul>
                            </div>
                        </form>
                        <div class="priduct_social">
                            <h3>Chia sẻ</h3>
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
    </div>';
    }
}

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.thumbnail-image').on('click', function(e){
            e.preventDefault();
            var newImage = $(this).data('image');
            $('#main-product-image').attr('src', newImage);
        });
    });
    $(document).ready(function(){
        $('#size').on('change', function(){
            var selectedSize = $(this).val();
            console.log("Đã chọn size:", selectedSize);
        });
    });

</script>