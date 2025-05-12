<?php
ob_start();
session_start();
require_once 'config-database.php';

// Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['product_error'] = 'Yêu cầu không hợp lệ.';
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    header('Location: ../frontEnd/admin.php?page=products');
    exit;
}

// Lấy dữ liệu từ form
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$subcategory = isset($_POST['subcategory']) ? (int)$_POST['subcategory'] : 0;
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
$sizes = isset($_POST['sizes']) ? $_POST['sizes'] : [];
$colors = isset($_POST['colors']) ? $_POST['colors'] : [];
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

// Kiểm tra các trường bắt buộc
if (empty($name) || $subcategory <= 0 || $price <= 0 || empty($sizes) || empty($colors) || $quantity <= 0 || empty($_FILES['image']['name'])) {
    $_SESSION['product_error'] = 'Vui lòng điền đầy đủ các trường bắt buộc.';
    error_log("Missing required fields: name=$name, subcategory=$subcategory, price=$price, sizes=" . json_encode($sizes) . ", colors=" . json_encode($colors) . ", quantity=$quantity, image=" . ($_FILES['image']['name'] ?? 'none'));
    header('Location:  ../frontEnd/admin.php?page=products');
    exit;
}

// Kiểm tra danh mục con hợp lệ
$result = $conn->query("SELECT id FROM subcategories WHERE id = " . (int)$subcategory);
if (!$result || $result->num_rows === 0) {
    $_SESSION['product_error'] = 'Danh mục con không hợp lệ.';
    error_log("Invalid subcategory: id=$subcategory");
    header('Location:  ../frontEnd/admin.php?page=products');
    exit;
}
$result->free();

// Kiểm tra và upload hình ảnh
$image = $_FILES['image'];
$allowed_types = ['image/jpeg', 'image/png'];
$max_size = 5 * 1024 * 1024; // 5MB
$upload_dir = '../assets/img/product/';
$image_name = uniqid() . '_' . basename($image['name']);
$image_path = $upload_dir . $image_name;

if (!in_array($image['type'], $allowed_types)) {
    $_SESSION['product_error'] = 'Hình ảnh phải là định dạng JPG hoặc PNG.';
    error_log("Invalid image type: type=" . $image['type']);
    header('Location:  ../frontEnd/admin.php?page=products');
    exit;
}

if ($image['size'] > $max_size) {
    $_SESSION['product_error'] = 'Hình ảnh không được vượt quá 5MB.';
    error_log("Image too large: size=" . $image['size']);
    header('Location:  ../frontEnd/admin.php?page=products');
    exit;
}

if (!move_uploaded_file($image['tmp_name'], $image_path)) {
    $_SESSION['product_error'] = 'Lỗi khi upload hình ảnh.';
    error_log("Failed to upload image: name=" . $image['name']);
    header('Location:  ../frontEnd/admin.php?page=products');
    exit;
}

// Thêm sản phẩm vào bảng products
$image_url = $image_path;
$name = $conn->real_escape_string($name);
$description = $conn->real_escape_string($description);
$query = "INSERT INTO products (subcategories_id, name, description, price, image_url_1)
          VALUES ($subcategory, '$name', '$description', $price, '$image_url')";
if ($conn->query($query) === TRUE) {
    $product_id = $conn->insert_id;

    // Thêm kích thước/màu sắc/số lượng vào products_size_color
    foreach ($sizes as $size_id) {
        foreach ($colors as $color_id) {
            $size_id = (int)$size_id;
            $color_id = (int)$color_id;
            $query = "INSERT INTO products_size_color (id_product, id_size, id_color, quantity)
                      VALUES ($product_id, $size_id, $color_id, $quantity)";
            if (!$conn->query($query)) {
                $_SESSION['product_error'] = 'Lỗi khi thêm kích thước/màu sắc: ' . $conn->error;
                error_log("Failed to add products_size_color: product_id=$product_id, size_id=$size_id, color_id=$color_id, error=" . $conn->error);
                // Xóa hình ảnh nếu thất bại
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                // Xóa sản phẩm vừa thêm
                $conn->query("DELETE FROM products WHERE id = $product_id");
                header('Location:  ../frontEnd/admin.php?page=products');
                exit;
            }
        }
    }

    // Đặt thông báo thành công
    $_SESSION['product_success'] = 'Thêm sản phẩm thành công!';
    error_log("Product added successfully: id=$product_id, name=$name, subcategory=$subcategory, sizes=" . json_encode($sizes) . ", colors=" . json_encode($colors) . ", quantity=$quantity");
    header('Location:  ../frontEnd/admin.php?page=products');
    exit;
} else {
    $_SESSION['product_error'] = 'Lỗi khi thêm sản phẩm: ' . $conn->error;
    error_log("Failed to add product: name=$name, error=" . $conn->error);
    // Xóa hình ảnh nếu lưu thất bại
    if (file_exists($image_path)) {
        unlink($image_path);
    }
    header('Location:  ../frontEnd/admin.php?page=products');
    exit;
}

$conn->close();
ob_end_flush();
?>