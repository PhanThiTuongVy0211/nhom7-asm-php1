<?php

require_once '../Controllers/CategoryController.php';

$categoryCtrl = new CategoryController();

if (isset($_POST['btn-add'])) {
    $category_name = trim($_POST['category_name']);
    $categoryCtrl->store($category_name);
}


if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryCtrl->delete($id);
}


$listCategories = $categoryCtrl->index();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Danh mục - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <h2 class="mb-4 text-center text-primary text-uppercase fw-bold">Quản Lý Danh Mục Sản Phẩm</h2>
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">Thêm Danh Mục Mới</div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Nhập tên danh mục..." required>
                        </div>
                        <button type="submit" name="btn-add" class="btn btn-success w-100 fw-bold">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white fw-bold">Danh Sách Danh Mục</div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="10%">STT</th>
                                <th width="20%">ID</th>
                                <th width="50%">Tên danh mục</th>
                                <th width="20%" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($listCategories)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">Chưa có danh mục nào.</td>
                                </tr>
                            <?php else: ?>
                                <?php $stt = 1; foreach ($listCategories as $cate): ?>
                                    <tr>
                                        <td><?= $stt++ ?></td>
                                        <td><?= $cate['id'] ?></td>
                                        <td><strong><?= htmlspecialchars($cate['name']) ?></strong></td>
                                        <td class="text-center">
                                            <a href="categories.php?action=delete&id=<?= $cate['id'] ?>" 
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                               class="btn btn-danger btn-sm">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>