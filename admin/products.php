<?php

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Bạn có thể đổi thành logic upload file nếu cần, ở đây lấy dạng chuỗi link ảnh tạm thời
    $category_id = $_POST['category_id'];

    $stmt = $db->prepare("INSERT INTO products (name, price, image, category_id) VALUES (:name, :price, :image, :category_id)");
    $stmt->execute(['name' => $name, 'price' => $price, 'image' => $image, 'category_id' => $category_id]);
    header("Location: products.php");
    exit();
}

// Lấy danh sách sản phẩm hiển thị lên bảng
$products = $db->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id")->fetchAll(PDO::FETCH_ASSOC);
// Lấy danh mục quần áo để đưa vào form chọn (select-box)
$categories = $db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm Thời Trang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
                <h3>Shop Admin</h3>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li><a href="dashboard.php" class="nav-link text-white">Tổng quan</a></li>
                    <li><a href="orders.php" class="nav-link text-white">Quản lý Đơn hàng</a></li>
                    <li><a href="products.php" class="nav-link text-white active">Quản lý Sản phẩm</a></li>
                    <li><a href="users.php" class="nav-link text-white">Quản lý Thành viên</a></li>
                </ul>
            </div>

            <div class="col-md-10 p-4">
                <h2>Quản Lý Sản Phẩm Thời Trang Nữ</h2>

                <div class="card my-4 p-3">
                    <h5>Thêm sản phẩm mới</h5>
                    <form method="POST" action="" class="row g-3">
                        <div class="col-md-3">
                            <input type="text" name="name" class="form-control" placeholder="Tên váy/đầm/áo..."
                                required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="price" class="form-control" placeholder="Giá bán (đ)" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="image" class="form-control"
                                placeholder="Tên file ảnh (vd: vay_nu.jpg)">
                        </div>
                        <div class="col-md-2">
                            <select name="category_id" class="form-select" required>
                                <option value="">Chọn danh mục</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-col-md-2">
                            <button type="submit" name="add_product" class="btn btn-success w-100">Thêm Mới</button>
                        </div>
                    </form>
                </div>

                <table class="table table-bordered bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $prod): ?>
                            <tr>
                                <td><?= $prod['id'] ?></td>
                                <td><img src="../assets/images/<?= $prod['image'] ?>" width="50" height="50" alt="Sản phẩm"
                                        style="object-fit:cover;"></td>
                                <td><?= $prod['name'] ?></td>
                                <td><?= $prod['category_name'] ?? 'Chưa phân loại' ?></td>
                                <td><?= number_format($prod['price']) ?> đ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>