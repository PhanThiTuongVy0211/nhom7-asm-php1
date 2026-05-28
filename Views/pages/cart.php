<?php

require_once __DIR__ . '/../../Controllers/CartController.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            background:#f4fff5;
        }

        .container{
            width:1200px;
            margin:auto;
            padding:30px 0;
        }

        /* HEADER */
        .header{
            background:white;
            padding:20px 30px;
            border-radius:24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
            box-shadow:0 4px 15px rgba(0,0,0,0.06);
        }

        .logo h1{
            color:#15803d;
            margin-bottom:5px;
        }

        .logo p{
            color:#666;
        }

        .menu{
            display:flex;
            gap:15px;
        }

        .menu a{
            text-decoration:none;
            background:#16a34a;
            color:white;
            padding:12px 20px;
            border-radius:14px;
            font-weight:bold;
            transition:0.3s;
        }

        .menu a:hover{
            background:#15803d;
        }

        /* CART */
        .cart-box{
            background:white;
            border-radius:24px;
            padding:25px;
            box-shadow:0 4px 15px rgba(0,0,0,0.06);
        }

        .cart-title{
            color:#15803d;
            margin-bottom:25px;
            font-size:30px;
        }

        .cart-item{
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:20px 0;
            border-bottom:1px solid #eee;
            gap:20px;
        }

        .cart-left{
            display:flex;
            align-items:center;
            gap:20px;
            flex:1;
        }

        .cart-left img{
            width:140px;
            height:140px;
            object-fit:cover;
            border-radius:18px;
        }

        .info h3{
            font-size:24px;
            margin-bottom:10px;
            color:#111827;
        }

        .info p{
            color:#666;
            margin-bottom:15px;
        }

        /* QTY */
        .qty{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .qty a{
            width:40px;
            height:40px;
            background:#16a34a;
            color:white;
            text-decoration:none;
            display:flex;
            justify-content:center;
            align-items:center;
            border-radius:10px;
            font-size:22px;
            transition:0.3s;
        }

        .qty a:hover{
            background:#15803d;
        }

        .qty span{
            font-size:20px;
            font-weight:bold;
            width:30px;
            text-align:center;
        }

        /* PRICE */
        .cart-right{
            text-align:right;
        }

        .price{
            color:#16a34a;
            font-size:28px;
            font-weight:bold;
            margin-bottom:15px;
        }

        .delete-btn{
            display:inline-block;
            background:#ef4444;
            color:white;
            padding:12px 18px;
            border-radius:12px;
            text-decoration:none;
            transition:0.3s;
        }

        .delete-btn:hover{
            background:#dc2626;
        }

        /* SUMMARY */
        .summary{
            margin-top:30px;
            background:white;
            border-radius:24px;
            padding:25px;
            box-shadow:0 4px 15px rgba(0,0,0,0.06);
        }

        .summary h2{
            color:#15803d;
            margin-bottom:20px;
        }

        .summary-row{
            display:flex;
            justify-content:space-between;
            margin-bottom:18px;
            font-size:18px;
        }

        .total{
            font-size:30px;
            font-weight:bold;
            color:#16a34a;
        }

        /* CHECKOUT */
        .checkout-box{
            margin-top:25px;
            text-align:right;
        }

        .checkout-btn{
            display:inline-block;
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:white;
            padding:18px 35px;
            border-radius:16px;
            text-decoration:none;
            font-size:18px;
            font-weight:bold;
            transition:0.3s;
            box-shadow:0 8px 20px rgba(34,197,94,0.3);
        }

        .checkout-btn:hover{
            transform:translateY(-3px);
            background:linear-gradient(135deg,#16a34a,#15803d);
        }

        /* EMPTY */
        .empty-cart{
            text-align:center;
            padding:50px 0;
        }

        .empty-cart h2{
            color:#666;
            margin-bottom:20px;
        }

        .shop-btn{
            display:inline-block;
            background:#16a34a;
            color:white;
            padding:14px 25px;
            border-radius:14px;
            text-decoration:none;
            font-weight:bold;
        }

        /* RESPONSIVE */
        @media(max-width:1024px){

            .container{
                width:95%;
            }

        }

        @media(max-width:768px){

            .header{
                flex-direction:column;
                gap:20px;
                text-align:center;
            }

            .menu{
                flex-wrap:wrap;
                justify-content:center;
            }

            .cart-item{
                flex-direction:column;
                align-items:flex-start;
            }

            .cart-left{
                flex-direction:column;
                align-items:flex-start;
            }

            .cart-left img{
                width:100%;
                height:300px;
            }

            .cart-right{
                width:100%;
                text-align:left;
            }

            .checkout-box{
                text-align:center;
            }

        }

    </style>

</head>
<body>
<div class="container">

    <!-- CART -->
    <div class="cart-box">

        <h2 class="cart-title">
            Giỏ hàng của bạn
        </h2>

        <?php if(count($cart) > 0): ?>

            <?php foreach($cart as $item): ?>

                <div class="cart-item">

                    <!-- LEFT -->
                    <div class="cart-left">

                        <img 
                            src="../../assets/<?php echo $item['image']; ?>"
                            alt=""
                        >

                        <div class="info">

                            <h3>
                                <?php echo $item['name']; ?>
                            </h3>

                            <p>
                                Thời trang nữ cao cấp
                            </p>

                            <div class="qty">

                                <!-- DECREASE -->
                                <a href="../../actions/decrease.php?id=<?php echo $item['id']; ?>">
                                    -
                                </a>

                                <span>
                                    <?php echo $item['qty']; ?>
                                </span>

                                <!-- INCREASE -->
                                <a href="../../actions/increase.php?id=<?php echo $item['id']; ?>">
                                    +
                                </a>

                            </div>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="cart-right">

                        <div class="price">

                            <?php echo number_format($item['price'] * $item['qty']); ?>đ

                        </div>

                        <a 
                            href="../../actions/delete-cart.php?id=<?php echo $item['id']; ?>"
                            class="delete-btn"
                            onclick="return confirm('Xóa sản phẩm này?')"
                        >
                            Xóa sản phẩm
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-cart">

                <h2>
                    Giỏ hàng đang trống
                </h2>

                <a href="../pages/product.php" class="shop-btn">
                    Mua sắm ngay
                </a>

            </div>

        <?php endif; ?>

    </div>

    <!-- SUMMARY -->
    <?php if(count($cart) > 0): ?>

        <div class="summary">

            <h2>
                Tổng thanh toán
            </h2>

            <div class="summary-row">

                <span>Tạm tính</span>

                <span>
                    <?php echo number_format($subtotal); ?>đ
                </span>

            </div>

            <div class="summary-row">

                <span>Phí vận chuyển</span>

                <span>
                    <?php echo number_format($shipping); ?>đ
                </span>

            </div>

            <hr style="margin:20px 0;">

            <div class="summary-row total">

                <span>Tổng cộng</span>

                <span>
                    <?php echo number_format($total); ?>đ
                </span>

            </div>

        </div>

        <!-- CHECKOUT -->
        <div class="checkout-box">

            <a href="checkout.php" class="checkout-btn">
                Tiến hành thanh toán
            </a>

        </div>

    <?php endif; ?>

</div>
</body>
</html>
