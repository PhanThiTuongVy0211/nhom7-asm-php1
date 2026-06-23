<?php

$productModel = new ProductModel();
$orderModel = new OrderModel();

$totalProducts = $productModel->countProducts();
$totalOrders = $orderModel->countOrders();

?>

<div class="container mt-4">
    <h2>Dashboard Admin</h2>

    <div class="row">

        <div class="col-md-6">
            <div class="card p-3 text-center">
                <h3><?= $totalProducts ?></h3>
                <p>Tổng sản phẩm</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3 text-center">
                <h3><?= $totalOrders ?></h3>
                <p>Tổng đơn hàng</p>
            </div>
        </div>

    </div>
</div>