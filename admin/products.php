<?php
require_once "config.php"; 
// Thêm sản phẩm
if (isset($_POST['add_product'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category_id = $_POST['category_id'];

    $stmt = $db->prepare("
        INSERT INTO products (name, price, image, category_id)
        VALUES (:name, :price, :image, :category_id)
    ");

    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':image' => $image,
        ':category_id' => $category_id
    ]);

    header("Location: products.php");
    exit();
}

// Lấy danh sách sản phẩm
$products = $db->query("
    SELECT p.*, c.name AS category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
")->fetchAll(PDO::FETCH_ASSOC);

// Lấy danh mục
$categories = $db->query("
    SELECT * FROM categories
")->fetchAll(PDO::FETCH_ASSOC);

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

        <!-- Sidebar -->
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

        <!-- Main -->
        <div class="col-md-10 p-4">
            <h2>Quản Lý Sản Phẩm Thời Trang Nữ</h2>

            <!-- FORM ADD -->
            <div class="card my-4 p-3">
                <h5>Thêm sản phẩm mới</h5>

                <form method="POST" action="" class="row g-3">

                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control"
                               placeholder="Tên váy/đầm/áo..." required>
                    </div>

                    <div class="col-md-2">
                        <input type="number" name="price" class="form-control"
                               placeholder="Giá bán (đ)" required>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="image" class="form-control"
                               placeholder="Tên file ảnh (vd: vay_nu.jpg)">
                    </div>

                    <!-- FIX LỖI Ở ĐÂY -->
                    <div class="col-md-2">
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>">
                                    <?php echo $cat['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" name="add_product" class="btn btn-primary w-100">
                            Thêm
                        </button>
                    </div>

                </form>
            </div>

            <!-- LIST PRODUCT -->
            <div class="card p-3">
                <h5>Danh sách sản phẩm</h5>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Danh mục</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td><?php echo $p['id']; ?></td>
                                <td><?php echo $p['name']; ?></td>
                                <td><?php echo $p['price']; ?></td>
                                <td>
                                    <img src="../../assets/<?php echo $p['image']; ?>"
                                         width="60">
                                </td>
                                <td><?php echo $p['category_name']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
</body>
</html>