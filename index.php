
<?php

session_start();
 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Models
require_once "Models/Cart.php";
require_once "Models/Category.php";
require_once "Models/Order.php";
require_once "Models/Product.php";
require_once "Models/Products.php";
require_once "Models/User.php";
require_once "Models/Database.php";


// Controllers
require_once "Controllers/HomeController.php";
require_once "Controllers/ProductController.php";
require_once "Controllers/UserController.php";
require_once "Controllers/OrderController.php";
require_once "Controllers/CartController.php";
require_once "Controllers/CategoryController.php";

$db = new Database();
$pdo = $db -> connect();

require "Views/layouts/header.php";
$productModel = new Product($pdo);


if (isset($_GET['pages']) && !empty($_GET['pages'])) {
 
    switch ($_GET['pages']) {
 
        case "home":
            $controller = new HomeController($productModel);
            $controller->renderGiaoDien();
            break;
 
        case "chi-tiet-san-pham":
            require "Views/pages/product-detail.php";
            break;
 
        case "san-pham":
            require "Views/pages/product.php";
            break;
 
        case "gio-hang":
            require "Views/pages/cart.php";
            break;
 
        case "thanh-toan":
            require "Views/pages/checkout.php";
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
            // Xử lý đăng xuất
            session_destroy();
            header('Location: ?pages=home');
            exit;
        
        default:
            echo "<h2 style='text-align:center; margin-top:50px;'>404 - Trang không tồn tại</h2>";
            break;
    }
 
} else {
 
    $controller = new HomeController($productModel);
    $controller->renderGiaoDien();
 
}
 
require "Views/layouts/footer.php";
?>