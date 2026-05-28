<?php

require_once __DIR__ . '/../models/products.php';
require_once __DIR__ . '/../models/order.php';

$totalProducts = count($products);

$totalOrders = count($orders);

$totalRevenue = 0;

$completedOrders = 0;

$processingOrders = 0;

foreach($orders as $order){

    $totalRevenue += $order['total'];

    if($order['status'] == "Hoàn thành"){

        $completedOrders++;
    }

    if($order['status'] == "Đang xử lý"){

        $processingOrders++;
    }

}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

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

        /* TITLE */
        .title{
            color:#15803d;
            margin-bottom:25px;
            font-size:32px;
        }

        /* CARDS */
        .dashboard-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:25px;
            margin-bottom:35px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:24px;
            box-shadow:0 4px 15px rgba(0,0,0,0.06);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card h3{
            color:#666;
            margin-bottom:15px;
            font-size:18px;
        }

        .card .number{
            font-size:34px;
            font-weight:bold;
            color:#16a34a;
        }

        /* TABLE */
        .table-box{
            background:white;
            border-radius:24px;
            padding:25px;
            box-shadow:0 4px 15px rgba(0,0,0,0.06);
        }

        .table-title{
            color:#15803d;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#16a34a;
            color:white;
            padding:15px;
            text-align:left;
        }

        table td{
            padding:15px;
            border-bottom:1px solid #eee;
        }

        tr:hover{
            background:#f0fdf4;
        }

        .status{
            padding:8px 14px;
            border-radius:30px;
            font-size:14px;
            font-weight:bold;
            display:inline-block;
        }

        .processing{
            background:#fef3c7;
            color:#92400e;
        }

        .completed{
            background:#dcfce7;
            color:#166534;
        }

        .shipping{
            background:#dbeafe;
            color:#1d4ed8;
        }

        .cancel{
            background:#fee2e2;
            color:#991b1b;
        }

        @media(max-width:1024px){

            .container{
                width:95%;
            }

            .dashboard-grid{
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

            .dashboard-grid{
                grid-template-columns:1fr;
            }

            .table-box{
                overflow:auto;
            }

            table{
                min-width:900px;
            }

        }

    </style>

</head>
<body>

<div class="container">

   

    
    <!-- TITLE -->
    <h2 class="title">
        Quản lý đơn hàng
    </h2>

    <!-- CARDS -->
    <div class="dashboard-grid">

        <div class="card">

            <h3>Tổng sản phẩm</h3>

            <div class="number">

                <?php echo $totalProducts; ?>

            </div>

        </div>

        <div class="card">

            <h3>Tổng đơn hàng</h3>

            <div class="number">

                <?php echo $totalOrders; ?>

            </div>

        </div>

        <div class="card">

            <h3>Đơn hoàn thành</h3>

            <div class="number">

                <?php echo $completedOrders; ?>

            </div>

        </div>

        <div class="card">

            <h3>Doanh thu</h3>

            <div class="number">

                <?php echo number_format($totalRevenue); ?>đ

            </div>

        </div>

    </div>

    <!-- ORDERS -->
    <div class="table-box">

        <h2 class="table-title">
            Danh sách đơn hàng mới
        </h2>

        <table>

            <tr>

                <th>ID</th>
                <th>Khách hàng</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th>Ngày</th>

            </tr>

            <?php foreach($orders as $order): ?>

                <tr>

                    <td>
                        #<?php echo $order['id']; ?>
                    </td>

                    <td>
                        <?php echo $order['customer_name']; ?>
                    </td>

                    <td>
                        <?php echo $order['phone']; ?>
                    </td>

                    <td>
                        <?php echo $order['address']; ?>
                    </td>

                    <td>
                        <?php echo number_format($order['total']); ?>đ
                    </td>

                    <td>
                        <?php echo $order['payment_method']; ?>
                    </td>

                    <td>

                        <?php

                        $class = "";

                        if($order['status'] == "Đang xử lý"){
                            $class = "processing";
                        }

                        if($order['status'] == "Hoàn thành"){
                            $class = "completed";
                        }

                        if($order['status'] == "Đang giao"){
                            $class = "shipping";
                        }

                        if($order['status'] == "Đã hủy"){
                            $class = "cancel";
                        }

                        ?>

                        <span class="status <?php echo $class; ?>">

                            <?php echo $order['status']; ?>

                        </span>

                    </td>

                    <td>
                        <?php echo $order['created_at']; ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        </table>

    </div>

</div>

</body>
</html>