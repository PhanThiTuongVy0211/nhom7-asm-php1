
<?php

require_once __DIR__ . '/../../Controllers/ProductController.php';

$productController = new ProductController();

$products = $productController->index();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenStyle Fashion</title>

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

/* CONTAINER */
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
    margin-bottom:35px;
    box-shadow:0 4px 15px rgba(0,0,0,0.06);
}

.logo h1{
    color:#15803d;
    margin-bottom:5px;
    font-size:34px;
}

.logo p{
    color:#666;
    font-size:15px;
}

/* MENU */
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
    box-shadow:0 4px 10px rgba(34,197,94,0.25);
}

.menu a:hover{
    background:#15803d;
    transform:translateY(-2px);
}

/* TITLE */
.title{
    margin-bottom:30px;
    color:#15803d;
    font-size:30px;
}

/* PRODUCT GRID */
.products{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
}

/* PRODUCT CARD */
.product-card{
    background:white;
    border-radius:24px;
    overflow:hidden;
    transition:0.35s;
    box-shadow:0 4px 15px rgba(0,0,0,0.06);
    border:1px solid #ecfdf5;
    position:relative;
}

.product-card:hover{
    transform:translateY(-8px);
    box-shadow:0 12px 25px rgba(0,0,0,0.12);
}

/* IMAGE */
.product-card img{
    width:100%;
    height:320px;
    object-fit:cover;
    transition:0.4s;
}

.product-card:hover img{
    transform:scale(1.05);
}

/* CONTENT */
.product-content{
    padding:20px;
}

.product-content h3{
    font-size:20px;
    margin-bottom:12px;
    min-height:55px;
    color:#111827;
}

/* PRICE */
.price{
    color:#16a34a;
    font-size:26px;
    font-weight:bold;
    margin-bottom:15px;
}

/* DESCRIPTION */
.desc{
    color:#666;
    margin-bottom:20px;
    line-height:1.7;
    min-height:55px;
    font-size:14px;
}

/* BUTTON GROUP */
.btn-group{
    display:flex;
    gap:10px;
}

/* DETAIL BUTTON */
.detail-btn{
    flex:1;
    text-align:center;
    padding:14px;
    border-radius:14px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
    border:2px solid #16a34a;
    color:#16a34a;
    background:white;
}

.detail-btn:hover{
    background:#16a34a;
    color:white;
    transform:translateY(-2px);
}

/* CART BUTTON */
.cart-btn{
    flex:1;
    text-align:center;
    padding:14px;
    border-radius:14px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:white;
    box-shadow:0 4px 10px rgba(34,197,94,0.3);
    position:relative;
    overflow:hidden;
}

.cart-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(34,197,94,0.4);
    background:linear-gradient(135deg,#16a34a,#15803d);
}

.cart-btn:active{
    transform:scale(0.98);
}

.cart-btn::before{
    content:" ";
}

/* BADGE */
.product-card::after{
    content:"NEW";
    position:absolute;
    top:15px;
    right:15px;
    background:#16a34a;
    color:white;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

/* RESPONSIVE */
@media(max-width:1024px){

    .container{
        width:95%;
    }

    .products{
        grid-template-columns:repeat(2,1fr);
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

    .products{
        grid-template-columns:1fr;
    }

    .btn-group{
        flex-direction:column;
    }

    .title{
        text-align:center;
    }

}
    </style>

</head>

<body>

    <div class="container">

        <!-- TITLE -->
        <h2 class="title">
            Danh sách sản phẩm nổi bật
        </h2>

        <!-- PRODUCTS -->
        <div class="products">

            <?php foreach ($products as $product): ?>

                <div class="product-card">

                    <img
                        src="../../assets/<?php echo $product['image']; ?>"
                        alt="">

                    <div class="product-content">

                        <h3>
                            <?php echo $product['name']; ?>
                        </h3>

                        <div class="price">

                            <?php echo number_format($product['price']); ?>đ

                        </div>

                        <div class="desc">

                            <?php echo $product['description']; ?>

                        </div>

                        <div class="btn-group">

                            <!-- CHI TIẾT -->
                            <a
                                href="product-detail.php?id=<?php echo $product['id']; ?>"
                                class="detail-btn">
                                Chi tiết
                            </a>

                            <!-- THÊM GIỎ -->
                            <a
                                href="../../actions/add-cart.php?id=<?php echo $product['id']; ?>&name=<?php echo urlencode($product['name']); ?>&price=<?php echo $product['price']; ?>&image=<?php echo urlencode($product['image']); ?>"
                                class="detail-btn">
                                Thêm vào giỏ hàng
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</body>

</html>