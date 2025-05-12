<?php
include 'header.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.*, products.name, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $user_id";
$result = mysqli_query($conn, $sql);

$total = 0;
?>

<div class="shopping_cart_area">
    <div class="container">
        <form action="#">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <form action="update_cart.php" method="post">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_thumb">Ảnh</th>
                                        <th class="product_name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product_quantity">Số lượng</th>
                                        <th class="product_total">Thành tiền</th>
                                        <th class="product_remove">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): 
                                        $subtotal = $row['quantity'] * $row['price'];
                                        $total += $subtotal;
                                    ?>
                                    <tr id="product_<?= $row['product_id'] ?>">
                                        <td class="product_thumb"><img src="../assets/img/s-product/product2.jpg" alt=""></td>
                                        <td class="product_name"><?= $row['name'] ?></td>
                                        <td class="product-price"><?= number_format($row['price'], 0, ',', '.') ?>đ</td>
                                        <td class="product_quantity">
                                            <input min="1" max="100" value="<?= $row['quantity'] ?>" type="number" class="quantity" data-id="<?= $row['product_id'] ?>">
                                        </td>
                                        <td class="product_total" id="total_<?= $row['product_id'] ?>"><?= number_format($subtotal, 0, ',', '.') ?>đ</td>
                                        <td class="product_remove"><a href="#" data-id="<?= $row['product_id'] ?>"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút Cập nhật giá -->
            <div class="cart_submit">
                <button type="button" id="update_cart" class="checkout_btn">Cập nhật giỏ hàng</button>
            </div>

            <!-- Thanh toán -->
            <div class="coupon_area">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code right">
                            <h3>Thanh toán</h3>
                            <div class="coupon_inner">
                               <div class="cart_subtotal">
                                   <p>Tiền hàng</p>
                                   <p class="cart_amount"><?= number_format($total, 0, ',', '.') ?>đ</p>
                               </div>
                               <div class="cart_subtotal">
                                   <p>Phí vận chuyển</p>
                                   <p class="cart_amount">Miễn phí</p>
                               </div>
                               <div class="cart_subtotal">
                                   <p>Tổng</p>
                                   <p class="cart_amount grand_total"><?= number_format($total, 0, ',', '.') ?>đ</p>
                               </div>
                               <div class="checkout_btn">
                                   <a href="checkout.php">Thanh toán</a>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#update_cart').on('click', function () {
    let items = [];
    $('.quantity').each(function () {
        items.push({
            id: $(this).data('id'),
            quantity: $(this).val()
        });
    });

    $.ajax({
        url: 'update_cart.php',
        type: 'POST',
        data: { items: items },
        success: function (response) {
            let total = 0;
            $('.quantity').each(function () {
                const quantity = parseInt($(this).val());
                const productId = $(this).data('id');
                const priceText = $('#product_' + productId + ' .product-price').text();
                const price = parseInt(priceText.replace(/[^\d]/g, ''));
                const subtotal = quantity * price;
                total += subtotal;

                $('#total_' + productId).text(subtotal.toLocaleString('vi-VN') + 'đ');
            });

            $('.cart_amount').first().text(total.toLocaleString('vi-VN') + 'đ');
            $('.grand_total').text(total.toLocaleString('vi-VN') + 'đ');
        }
    });
});

</script>

<?php include 'footer.php'; ?>
