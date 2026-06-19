<?php


try {
    $host = '103.57.220.210';
    $dbname = 'web_thoi_trang_nu';
    $username = 'gtpixbirhosting_lethikieunguyen';
    $password = '';

    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}

// 2. LOGIC LẤY DỮ LIỆU THỐNG KÊ
try {
    // 1. Thống kê tổng doanh thu và tổng số đơn hàng
    $stmtOrder = $db->query("SELECT COUNT(id) as total_orders, SUM(total_price) as total_revenue FROM orders");
    $orderData = $stmtOrder->fetch(PDO::FETCH_ASSOC);

    // 2. Thống kê tổng số sản phẩm thời trang nữ
    $stmtProduct = $db->query("SELECT COUNT(id) as total_products FROM products");
    $productCount = $stmtProduct->fetch(PDO::FETCH_ASSOC)['total_products'];

    // 3. Thống kê tổng số khách hàng
    $stmtUser = $db->query("SELECT COUNT(id) as total_users FROM users WHERE role != 'admin'");
    $userCount = $stmtUser->fetch(PDO::FETCH_ASSOC)['total_users'];
} catch (Exception $e) {
    echo "Lỗi tải dữ liệu dashboard: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Shop Thời Trang Nữ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
                <h3>Shop Admin</h3>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item"><a href="dashboard.php" class="nav-link text-white active">Tổng quan</a></li>
                    <li><a href="orders.php" class="nav-link text-white">Quản lý Đơn hàng</a></li>
                    <li><a href="products.php" class="nav-link text-white">Quản lý Sản phẩm</a></li>
                    <li><a href="users.php" class="nav-link text-white">Quản lý Thành viên</a></li>
                </ul>
            </div>

            <div class="col-md-10 p-4">
                <h2>Bảng Điều Khiển Tổng Quan</h2>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Doanh Thu</h5>
                                <h3><?= number_format($orderData['total_revenue'] ?? 0) ?> đ</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Đơn Hàng</h5>
                                <h3><?= $orderData['total_orders'] ?? 0 ?> đơn</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Sản Phẩm Thời Trang</h5>
                                <h3><?= $productCount ?> mẫu</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Khách Hàng</h5>
                                <h3><?= $userCount ?> người</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>