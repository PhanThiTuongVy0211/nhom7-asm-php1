<?php

require_once '../../Controllers/CartController.php';

$cartController = new CartController();

$cart = $cartController->index();

$subtotal = $cartController->subtotal();

$shipping = 30000;

$total = $subtotal + $shipping;

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>

    <link rel="stylesheet" href="../../assets/css/cart-checkout.css">
</head>
<body>

<div class="container">

    <div class="header">

        <h1>Thanh toán đơn hàng</h1>

    </div>

    <div class="layout">

        <div class="form-box">

            <h2 class="title">Thông tin nhận hàng</h2>

            <div class="input-group">
                <input type="text" placeholder="Họ và tên">
            </div>

            <div class="input-group">
                <input type="text" placeholder="Số điện thoại">
            </div>

            <div class="input-group">
                <textarea placeholder="Địa chỉ"></textarea>
            </div>

            <h2 class="title">
                Phương thức thanh toán
            </h2>

            <div class="payment-method">
                <input type="radio" checked>
                Thanh toán khi nhận hàng
            </div>

            <div class="payment-method">
                <input type="radio">
                Chuyển khoản ngân hàng
            </div>

        </div>

        <div class="order-box">

            <h2 class="title">Đơn hàng</h2>

            <?php foreach($cart as $item): ?>

                <div class="summary-row">

                    <span>
                        <?= $item['name'] ?>
                        x <?= $item['qty'] ?>
                    </span>

                    <span>
                        <?= number_format($item['price'] * $item['qty']) ?>đ
                    </span>

                </div>

            <?php endforeach; ?>

            <hr><br>

            <div class="summary-row">
                <span>Tạm tính</span>
                <span><?= number_format($subtotal) ?>đ</span>
            </div>

            <div class="summary-row">
                <span>Phí ship</span>
                <span><?= number_format($shipping) ?>đ</span>
            </div>

            <div class="summary-row total">
                <span>Tổng cộng</span>
                <span><?= number_format($total) ?>đ</span>
            </div>

            <button class="order-btn">
                Đặt hàng
            </button>

        </div>

    </div>

</div>

</body>
</html>