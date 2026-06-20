<?php

session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'Models/Database.php';
// require_once 'Models/Product.php';
$db = new Database();
$pdo = $db->connect();

require_once "Controllers/HomeController.php";
require_once "Controllers/ProductController.php";
require_once "Controllers/OrderController.php";
require_once "Controllers/CartController.php"; 
require "Views/layouts/header.php";
require_once 'Models/Cart.php';

if (isset($_GET['pages']) && !empty($_GET['pages'])) {

    switch ($_GET['pages']) {

        case "home":
            $controller = new HomeController();
            $controller->index();
            break;

        case "chi-tiet-san-pham":
            require "Views/pages/product-detail.php";
            break;

        case "san-pham":
            require "Views/pages/products.php";
            break;

        // --- PHẦN GIAO CHO GIỎ HÀNG ---
        case "gio-hang":
            $controller = new CartController($pdo); // Truyền trực tiếp $pdo vào như các file Model
            $controller->index(); // Gọi hàm xử lý lấy dữ liệu (Session/CSDL) và require View
            break;

        case "them-gio-hang":
            $controller = new CartController($pdo);
            $controller->addToCart();
            break;

        case "cap-nhat-gio-hang":
            $controller = new CartController($pdo);
            $controller->update();
            break;

        case "thanh-toan":
            // Phần của Dung (Có thể dùng OrderController xử lý)
            $controller = new OrderController($pdo);
            $controller->checkout();
            break;

        // --- PHẦN GIAO CHO NGUYỄN: ADMIN THANH TOÁN / ĐƠN HÀNG ---
        case "admin-don-hang":
            $controller = new AdminOrderController($pdo);
            $controller->index();
            break;

        case "admin-chi-tiet-don-hang":
            $controller = new AdminOrderController($pdo);
            $controller->detail();
            break;

        case "admin-duyet-don-hang":
            $controller = new AdminOrderController($pdo);
            $controller->updateStatus();
            break;

        case "dang-nhap":
            require "Views/pages/login.php";
            break;

        case "dang-ky":
            require "Views/pages/register.php";
            break;

        case "quen-mat-khau":
            require "Views/pages/forgot-password.php";
            break;

        case "ho-so":
            require "Views/pages/profile.php";
            break;

        case "dang-xuat":
            session_destroy();
            header('Location: ?pages=home');
            exit;

        default:
            echo "<h2 style='text-align:center; margin-top:50px;'>404 - Trang không tồn tại</h2>";
            break;
    }

} else {
    $controller = new HomeController();
    $controller->index();
}

require "Views/layouts/footer.php";
?>