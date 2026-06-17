<?php
// Controllers/CartController.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'Models/Cart.php';

class CartController
{
    private $cartModel;

    public function __construct($pdo)
    {
        $this->cartModel = new Cart($pdo);
    }

    // [Dòng 13 + 14] Điều hướng và hiển thị danh sách sản phẩm trong giỏ hàng
    public function index()
    {
        $cartItems = [];

        if (isset($_SESSION['user_id'])) {
            // Dòng 14: Lấy danh sách sản phẩm từ CSDL nếu đã đăng nhập
            $cartItems = $this->cartModel->getCartFromDB($_SESSION['user_id']);
        } else {
            // Dòng 13: Lấy danh sách sản phẩm từ SESSION nếu chưa đăng nhập
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $cartItems = $_SESSION['cart'];
            }
        }

        // Gọi View hiển thị giao diện giỏ hàng
        require_once 'Views/pages/cart.php';
    }

    // [Dòng 15] Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            $cartId = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0; // Dùng cho CSDL
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

            if (isset($_SESSION['user_id'])) {
                // Cập nhật trong CSDL
                $this->cartModel->updateQuantityInDB($cartId, $quantity);
            } else {
                // Cập nhật trong SESSION
                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$productId]);
                } else {
                    if (isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity'] = $quantity;
                    }
                }
            }
            header("Location: index.php?action=cart");
            exit();
        }
    }

    // Hàm hỗ trợ thêm sản phẩm vào giỏ hàng (Xử lý cả Session & CSDL)
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id']);
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

            // Giả định dữ liệu sản phẩm lấy từ ProductModel (ở đây demo mảng cứng)
            $productName = $_POST['product_name'];
            $productPrice = floatval($_POST['product_price']);
            $productImg = isset($_POST['product_img']) ? $_POST['product_img'] : '';

            if (isset($_SESSION['user_id'])) {
                // Lưu vào CSDL
                $this->cartModel->addToCartDB($_SESSION['user_id'], $productId, $quantity);
            } else {
                // Lưu vào SESSION
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                if (isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId]['quantity'] += $quantity;
                } else {
                    $_SESSION['cart'][$productId] = [
                        'id' => $productId,
                        'name' => $productName,
                        'price' => $productPrice,
                        'img' => $productImg,
                        'quantity' => $quantity
                    ];
                }
            }
            header("Location: index.php?action=cart");
            exit();
        }
    }
}