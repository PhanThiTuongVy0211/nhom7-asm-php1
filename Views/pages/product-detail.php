<?php
if (!isset($product)) {
    echo "Không có dữ liệu sản phẩm";
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $product['name']; ?>
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial;
        }

        body {
            background: #f4fff5;
        }

        .container {
            width: 1200px;
            margin: auto;
            padding: 30px 0;
        }

        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .logo h1 {
            color: #15803d;
            margin-bottom: 5px;
        }

        .logo p {
            color: #666;
        }

        .menu {
            display: flex;
            gap: 15px;
        }

        .menu a {
            text-decoration: none;
            background: #16a34a;
            color: white;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        .menu a:hover {
            background: #15803d;
        }

        .detail-box {
            background: white;
            border-radius: 25px;
            padding: 35px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .detail-image img {
            width: 100%;
            height: 650px;
            object-fit: cover;
            border-radius: 20px;
        }

        .detail-content h1 {
            font-size: 38px;
            margin-bottom: 20px;
            color: #111827;
        }

        .price {
            color: #16a34a;
            font-size: 35px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .desc {
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .feature-box {
            background: #f0fdf4;
            padding: 20px;
            border-radius: 18px;
            margin-bottom: 30px;
        }

        .feature {
            margin-bottom: 15px;
            color: #444;
        }

        .feature:last-child {
            margin-bottom: 0;
        }

        .feature span {
            color: #15803d;
            font-weight: bold;
        }

        .quantity-box {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .quantity-box button {
            width: 40px;
            height: 40px;
            border: none;
            background: #16a34a;
            color: white;
            border-radius: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .quantity-input {
            width: 70px;
            height: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 18px;
        }

        .action {
            display: flex;
            gap: 15px;
        }

        .buy-btn,
        .cart-btn {
            flex: 1;
            padding: 16px;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            font-size: 17px;
        }

        .buy-btn {
            background: #16a34a;
            color: white;
        }

        .buy-btn:hover {
            background: #15803d;
        }

        .cart-btn {
            border: 2px solid #16a34a;
            color: #16a34a;
        }

        .cart-btn:hover {
            background: #16a34a;
            color: white;
        }

        .extra-info {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .extra-card {
            background: white;
            padding: 20px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .extra-card h3 {
            color: #15803d;
            margin-bottom: 10px;
        }

        .extra-card p {
            color: #666;
            line-height: 1.6;
        }

        @media(max-width:1024px) {

            .container {
                width: 95%;
            }

            .detail-box {
                grid-template-columns: 1fr;
            }

            .detail-image img {
                height: 500px;
            }

        }

        @media(max-width:768px) {

            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .detail-content h1 {
                font-size: 30px;
            }

            .price {
                font-size: 28px;
            }

            .action {
                flex-direction: column;
            }

            .extra-info {
                grid-template-columns: 1fr;
            }

        }
    </style>

</head>

<body>

    <div class="container">



        <!-- PRODUCT DETAIL -->
        <div class="detail-box">

            <!-- IMAGE -->
            <div class="detail-image">
                <img src="assets/images/<?php echo $product['Image']; ?>" alt="<?php echo $product['Title']; ?>">
            </div>

            <!-- CONTENT -->
            <div class="detail-content">

                <h1>
                    <?php echo $product['Title']; ?>
                </h1>

                <div class="price">
                    Sản phẩm thời trang nữ
                </div>
                <div class="desc">

                    <?php echo $product['Description']; ?>

                    Sản phẩm mang phong cách nữ tính hiện đại,
                    phù hợp đi học, đi chơi, công sở và cafe cuối tuần.
                </div>

                <!-- FEATURE -->
                <div class="feature-box">

                    <div class="feature">
                        <span>Chất liệu:</span>
                        Cotton cao cấp
                    </div>

                    <div class="feature">
                        <span>Màu sắc:</span>
                        Xanh pastel / Trắng / Kem
                    </div>

                    <div class="feature">
                        <span>Size:</span>
                        S - M - L
                    </div>

                    <div class="feature">
                        <span>Phong cách:</span>
                        Hàn Quốc trẻ trung
                    </div>

                </div>

                <!-- QUANTITY -->
                <div class="quantity-box">

                    <button onclick="decreaseQty()">
                        -
                    </button>

                    <input type="text" id="qty" value="1" class="quantity-input">

                    <button onclick="increaseQty()">
                        +
                    </button>

                </div>

                <!-- BUTTON -->
                <div class="action">

                    <a href="?pages=gio-hang&id=<?php echo $product['ID']; ?>" class="buy-btn">
                        <class="buy-btn">
                            Thêm vào giỏ hàng
                    </a>

                    <a href="cart.php" class="cart-btn">
                        Xem giỏ hàng
                    </a>

                </div>

            </div>

        </div>

        <!-- EXTRA INFO -->
        <div class="extra-info">

            <div class="extra-card">

                <h3>Miễn phí vận chuyển</h3>

                <p>
                    Freeship cho đơn hàng từ 500.000đ
                </p>

            </div>

            <div class="extra-card">

                <h3>Đổi trả dễ dàng</h3>

                <p>
                    Hỗ trợ đổi trả trong 7 ngày
                </p>

            </div>

            <div class="extra-card">

                <h3>Thanh toán an toàn</h3>

                <p>
                    Hỗ trợ COD và chuyển khoản
                </p>

            </div>

        </div>

    </div>

    <script>
        function increaseQty() {

            let qty = document.getElementById("qty");

            qty.value = parseInt(qty.value) + 1;
        }

        function decreaseQty() {

            let qty = document.getElementById("qty");

            if (parseInt(qty.value) > 1) {

                qty.value = parseInt(qty.value) - 1;
            }
        }
    </script>

</body>

</html>