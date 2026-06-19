<?php


// Xử lý cập nhật trạng thái đơn hàng 
if (isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];
    $stmt = $db->prepare("UPDATE orders SET status = :status WHERE id = :id");
    $stmt->execute(['status' => $status, 'id' => $orderId]);
    header("Location: orders.php");
    exit();
}

// Lấy danh sách đơn hàng kèm thông tin email người đặt
$orders = $db->query("SELECT o.*, u.email FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>
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
                    <li><a href="orders.php" class="nav-link text-white active">Quản lý Đơn hàng</a></li>
                    <li><a href="products.php" class="nav-link text-white">Quản lý Sản phẩm</a></li>
                    <li><a href="users.php" class="nav-link text-white">Quản lý Thành viên</a></li>
                </ul>
            </div>

            <div class="col-md-10 p-4">
                <h2>Danh Sách Đơn Hàng Mới Đặt</h2>
                <table class="table table-bordered table-striped mt-4 bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>Mã Đơn</th>
                            <th>Khách Hàng (Email)</th>
                            <th>Tổng Tiền</th>
                            <th>Ngày Đặt</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?= $order['id'] ?></td>
                                <td><?= $order['email'] ?></td>
                                <td><?= number_format($order['total_price']) ?> đ</td>
                                <td><?= $order['created_at'] ?></td>
                                <td>
                                    <span class="badge bg-<?= $order['status'] == 'pending' ? 'warning' : 'success' ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="" class="d-inline-flex gap-2">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Chờ
                                                xử lý</option>
                                            <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>
                                                Đã hoàn thành</option>
                                            <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>
                                                Hủy đơn</option>
                                        </select>
                                        <button type="submit" name="update_status" class="btn btn-sm btn-primary">Cập
                                            nhật</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>