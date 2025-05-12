<?php
require_once '../config-database.php';
session_start();

// Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = (int)$_POST['product_id'];
    $name = trim($_POST['name']);
    $subcategory = (int)$_POST['subcategory'];
    $description = trim($_POST['description']);
    $price = (float)$_POST['price'];
    $size = (int)$_POST['size'];
    $color = (int)$_POST['color'];
    $quantity = (int)$_POST['quantity'];


    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($subcategory) || empty($price) || empty($size) || empty($color)) {
        $_SESSION['product_error'] = "Vui lòng điền đầy đủ các trường bắt buộc.";
        header("Location: edit-product.php?id=$product_id");
        exit();
    }

    // Kiểm tra số lượng hợp lệ
    if ($quantity < 0) {
        $_SESSION['product_error'] = "Số lượng không được âm.";
        header("Location: edit-product.php?id=$product_id");
        exit();
    }

    // Xử lý upload hình ảnh
    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png'];
        $max_size = 2 * 1024 * 1024; // 2MB
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['image']['name']);
        $upload_dir = '../../img/product/';
        $upload_path = $upload_dir . $file_name;

        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['product_error'] = "Chỉ chấp nhận file JPG hoặc PNG.";
            header("Location: edit-product.php?id=$product_id");
            exit();
        }

        if ($file_size > $max_size) {
            $_SESSION['product_error'] = "Kích thước file không được vượt quá 2MB.";
            header("Location: edit-product.php?id=$product_id");
            exit();
        }

        if (move_uploaded_file($file_tmp, $upload_path)) {
            $image_url = '../img/product/' . $file_name;
        } else {
            $_SESSION['product_error'] = "Lỗi khi upload hình ảnh.";
            header("Location: edit-product.php?id=$product_id");
            exit();
        }
    }

    // Lấy psc.id từ products_size_color dựa trên product_id
    $stmt = $conn->prepare("SELECT id_product FROM products_size_color WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $_SESSION['product_error'] = "Bản ghi kích thước/màu sắc không tồn tại.";
        header("Location: edit-product.php?id=$product_id");
        exit();
    }
    $psc = $result->fetch_assoc();
    $id = $psc['id_product'];
    $stmt->close();

    // Cập nhật thông tin sản phẩm
    if ($image_url) {
        $stmt = $conn->prepare("
            UPDATE products
            SET name = ?, subcategories_id = ?, description = ?, price = ?, image_url_1 = ?
            WHERE id = ?
        ");
        $stmt->bind_param("sisdsi", $name, $subcategory, $description, $price, $image_url, $id);
    } else {
        $stmt = $conn->prepare("
            UPDATE products
            SET name = ?, subcategories_id = ?, description = ?, price = ?
            WHERE id = ?
        ");
        $stmt->bind_param("sisdi", $name, $subcategory, $description, $price, $id);
    }

    if ($stmt->execute()) {
        // Cập nhật bản ghi products_size_color
        $stmt = $conn->prepare("
            UPDATE products_size_color
            SET id_size = ?, id_color = ?, quantity = ?
            WHERE id = ?
        ");
        $stmt->bind_param("iiii", $size, $color, $quantity, $product_id);

        if ($stmt->execute()) {
            $_SESSION['product_success'] = "Cập nhật sản phẩm thành công.";
            header("Location: ../../frontEnd/admin.php?page=products");
        } else {
            $_SESSION['product_error'] = "Lỗi khi cập nhật kích thước/màu sắc/số lượng.";
            header("Location: edit-product.php?id=$$product_id");
        }
        $stmt->close();
    } else {
        $_SESSION['product_error'] = "Lỗi khi cập nhật sản phẩm.";
        header("Location: edit-product.php?id=$product_id");
    }
    $stmt->close();
} else {
    $_SESSION['product_error'] = "Phương thức không hợp lệ.";
    header("Location: edit-product.php?id=$product_id");
}

$conn->close();
?>