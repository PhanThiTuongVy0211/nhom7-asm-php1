<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class CartController {

    // Lấy giỏ hàng
    public function index(){

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        return $_SESSION['cart'];
    }

    // Thêm sản phẩm
    public function add($product){

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        $found = false;

        foreach($_SESSION['cart'] as &$item){

            if($item['id'] == $product['id']){

                $item['qty']++;
                $found = true;
                break;
            }
        }

        if(!$found){

            $product['qty'] = 1;

            $_SESSION['cart'][] = $product;
        }
    }

    // Xóa sản phẩm
    public function delete($id){

        foreach($_SESSION['cart'] as $key => $item){

            if($item['id'] == $id){

                unset($_SESSION['cart'][$key]);
            }
        }

        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Tăng số lượng
    public function increase($id){

        foreach($_SESSION['cart'] as &$item){

            if($item['id'] == $id){

                $item['qty']++;
            }
        }
    }

    // Giảm số lượng
    public function decrease($id){

        foreach($_SESSION['cart'] as $key => &$item){

            if($item['id'] == $id){

                $item['qty']--;

                if($item['qty'] <= 0){

                    unset($_SESSION['cart'][$key]);
                }
            }
        }

        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Tổng tiền
    public function subtotal(){

        $total = 0;

        if(isset($_SESSION['cart'])){

            foreach($_SESSION['cart'] as $item){

                $total += $item['price'] * $item['qty'];
            }
        }

        return $total;
    }

    // Tổng số lượng
    public function totalQty(){

        $qty = 0;

        if(isset($_SESSION['cart'])){

            foreach($_SESSION['cart'] as $item){

                $qty += $item['qty'];
            }
        }

        return $qty;
    }

}
?>