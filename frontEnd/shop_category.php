<?php include 'header.php'; ?>

<?php
include '../backEnd/config-database.php';

include 'views/show-product.php';

$subcategoryId = $_GET['subcategories_id'] ?? null;

$products = $subcategoryId ? getProductsBySubcategory($conn, $subcategoryId) : [];
?>

<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <!-- Danh sách sản phẩm -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <?php
                if (empty($products)) {
                    echo '<div class="col-12"><p>Không có sản phẩm nào trong danh mục này.</p></div>';
                } else {
                    showProducts($products, $conn);

                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Shop End -->

<?php include 'footer.php'; ?>
