<?php

session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'Models/Database.php';

$db = new Database();

/** @var PDO $pdo */
$pdo = $db->connect(); // Đã kích hoạt kết nối và gán vào biến $pdo để dùng cho các Controller bên dưới

// --- NẠP CÁC FILE CONTROLLER ---
require_once "Controllers/HomeController.php";
require_once "Controllers/ProductController.php";
require_once "Controllers/CartController.php";
require_once "Controllers/OrderController.php"; 
// Nạp file chứa lớp AdminOrderController của bạn

// --- NẠP CÁC THÀNH PHẦN KHÁC ---
require "Views/layouts/header.php";
require_once 'Models/Cart.php';
require_once 'Models/Order.php';
require_once "Models/Category.php";
 // Đã bổ sung nạp đúng Model quản lý đơn hàng công việc của Nguyên

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
            $controller = new CartController($pdo);
            $controller->index();
            break;

        case "them-gio-hang":
            $controller = new CartController($pdo);
            if (method_exists($controller, 'addToCart')) {
                $controller->addToCart();
            }
            break;

        case "cap-nhat-gio-hang":
            $controller = new CartController($pdo);
            $controller->update();
            break;

        // ĐÃ SỬA LỖI: Thay OrderController thành AdminOrderController cho đúng với lớp thực tế bạn khai báo
        case "thanh-toan":
            $controller = new AdminOrderController($pdo);
            if (method_exists($controller, 'checkout')) {
                $controller->checkout();
            } else {
                // Nếu chưa viết hàm checkout, tạm thời gọi hàm index để hiển thị giao diện danh sách đơn hàng
                $controller->index();
            }
            break;

        // --- ADMIN THANH TOÁN / ĐƠN HÀNG (PHẦN CỦA NGUYỄN) ---
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