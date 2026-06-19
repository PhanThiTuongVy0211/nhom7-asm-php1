<?php

$users = $db->query("SELECT id, name, email, role, created_at FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý thành viên</title>
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
                    <li><a href="products.php" class="nav-link text-white">Quản lý Sản phẩm</a></li>
                    <li><a href="users.php" class="nav-link text-white active">Quản lý Thành viên</a></li>
                </ul>
            </div>

            <div class="col-md-10 p-4">
                <h2>Quản Lý Danh Sách Thành Viên</h2>

                <table class="table table-bordered table-striped mt-4 bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>ID tài khoản</th>
                            <th>Họ và Tên</th>
                            <th>Địa chỉ Email</th>
                            <th>Quyền hạn</th>
                            <th>Ngày tham gia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>#<?= $user['id'] ?></td>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $user['role'] == 'admin' ? 'danger' : 'secondary' ?>">
                                        <?= $user['role'] ?>
                                    </span>
                                </td>
                                <td><?= $user['created_at'] ?? 'Không rõ' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>