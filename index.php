<?php
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'Models/Cart.php';
require_once "Models/database.php";
$database = new Database();
$db = $database->connect();

require_once "Models/Product.php";

$productModel = new ProductModel();
require_once "Controllers/HomeController.php";
require_once "Controllers/ProductController.php";
require_once "Controllers/UserController.php";
require_once "Controllers/OrderController.php";
require_once "Controllers/CartController.php";

if (isset($_GET['pages']) && $_GET['pages'] === 'dang-xuat') {
    session_destroy();
    header('Location: ?pages=home');
    exit;
}

require "Views/layouts/header.php";

$page = isset($_GET['pages']) && !empty($_GET['pages']) ? $_GET['pages'] : 'home';

switch ($page) {

    case "home":
        $controller = new HomeController($productModel);
        $controller->renderGiaoDien();
        break;

    case "chi-tiet-san-pham":
        $controller = new ProductController($productModel);
        $controller->detail();
        break;

    case "san-pham":
        $controller = new ProductController($productModel);
        $controller->list();
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

    default:
        echo "<h2 style='text-align:center; margin-top:50px;'>404 - Trang không tồn tại</h2>";
        break;
}

require "Views/layouts/footer.php";
?>

