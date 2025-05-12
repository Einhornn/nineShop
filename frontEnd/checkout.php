<?php
include 'header.php';
$user_id = $_SESSION['user_id'];

$user_query = mysqli_query($conn, "SELECT name, email FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($user_query);

$cart_items = mysqli_query($conn, "SELECT cart.*, products.price, products.name 
                                   FROM cart 
                                   JOIN products ON cart.product_id = products.id 
                                   WHERE cart.user_id = $user_id");

if (mysqli_num_rows($cart_items) == 0) {
    echo "<div class='container mt-4 alert alert-warning'>Giỏ hàng của bạn đang trống.</div>";
    include 'footer.php';
    exit;
}
?>

<div class="container mt-5 mb-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center">Thanh toán đơn hàng</h2>

        <div class="mb-4">
            <h4>Thông tin khách hàng</h4>
            <p><strong>Họ tên:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>

        <form action="process_order.php" method="post">
            <div class="mb-3">
                <h4><label for="address" class="form-label">Địa chỉ giao hàng</label></h4>
                <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ nhận hàng" required>
                <span class="error-message" id="addressError">Vui lòng nhập địa chỉ!</span>

            </div>

            <div class="mb-3">
                <h4><label for="payment_method" class="form-label">Phương thức thanh toán</label></h4>
                <select class="form-select" name="payment_method" required>
                    <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                    <option value="bank">Chuyển khoản ngân hàng</option>
                </select>
            </div>

            <hr>
            <h4>Chi tiết đơn hàng</h4>
            <ul class="list-group mb-3">
                <?php
                $total = 0;
                mysqli_data_seek($cart_items, 0);
                while ($row = mysqli_fetch_assoc($cart_items)) {
                    $subtotal = $row['price'] * $row['quantity'];
                    $total += $subtotal;
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                            <span>{$row['name']} x {$row['quantity']}</span>
                            <strong>" . number_format($subtotal, 0, ',', '.') . "đ</strong>
                          </li>";
                }
                ?>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Tổng cộng:</strong>
                    <strong><?= number_format($total, 0, ',', '.') ?>đ</strong>
                </li>
            </ul>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Xác nhận đặt hàng</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.querySelector("form").addEventListener("submit", function (e) {
    const addressInput = document.querySelector("input[name='address']");
    const addressError = document.getElementById("addressError");
    let isValid = true;

    addressError.style.display = "none";

    if (!addressInput.value.trim()) {
        addressError.style.display = "block";
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});

</script>

<?php include 'footer.php'; ?>
