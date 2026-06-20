<!-- Chi tiết bài viết -->

<?php

class OrderController {

    public function checkout() {

        $carts = $_SESSION['cart'] ?? [];

        $total = 0;

        foreach ($carts as $item) {
            $total += $item['price'] * $item['qty'];
        }

        require "Views/pages/checkout.php";
    }

    public function placeOrder() {

        $_SESSION['cart'] = [];

        header("Location: ?pages=home");
    }
}